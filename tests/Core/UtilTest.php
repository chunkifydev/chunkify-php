<?php

namespace Tests\Core;

use Chunkify\Core\Util;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversNothing]
class UtilTest extends TestCase
{
    #[Test]
    public function testMapRecursive(): void
    {
        $cases = [
            [
                [],
                [],
                static fn ($v) => $v,
            ],
            [
                ['a' => null, 'b' => [null, null], 'c' => ['d' => null, 'e' => 0], 'f' => ['g' => null]],
                ['b' => [null, null], 'c' => ['e' => 0], 'f' => []],
                static fn ($vs) => is_array($vs) && !array_is_list($vs) ? array_filter($vs, callback: static fn ($v) => !is_null($v)) : $vs,
            ],
            [
                ['a' => null, 'b' => 2, 'c' => true, 'd' => [1, 2]],
                ['a' => null, 'b' => '2', 'c' => true, 'd' => ['1', '2']],
                static fn ($v) => is_bool($v) || is_numeric($v) ? Util::strVal($v) : $v,
            ],
        ];

        foreach ($cases as [$input, $expected, $xform]) {
            $actual = Util::mapRecursive($xform, value: $input);
            $this->assertEquals($expected, $actual);
        }
    }

    #[Test]
    public function testJoinUri(): void
    {
        $factory = Psr17FactoryDiscovery::findUriFactory();
        $base = $factory->createUri('http://localhost');
        $util = new \ReflectionClass(Util::class);

        /** @var 'brackets'|'comma'|'indices'|'repeat' $arrayFormat */
        $arrayFormat = $util->getConstant('QUERY_ARRAY_FORMAT');

        /** @var 'brackets'|'dots' $nestedFormat */
        $nestedFormat = $util->getConstant('QUERY_NESTED_FORMAT');
        $nestedKey = 'dots' === $nestedFormat ? 'dog.dog' : 'dog%5Bdog%5D';
        $cases = [
            [
                '',
                [],
                'http://localhost',
            ],
            [
                'dog',
                [],
                'http://localhost/dog',
            ],
            [
                '',
                ['dog' => 'dog'],
                'http://localhost?dog=dog',
            ],
            [
                '',
                ['dog' => ['dog']],
                match ($arrayFormat) {
                    'brackets' => 'http://localhost?dog%5B%5D=dog',
                    'indices' => 'http://localhost?dog%5B0%5D=dog',
                    'comma', 'repeat' => 'http://localhost?dog=dog',
                },
            ],
            [
                '',
                ['dog' => [true, false]],
                match ($arrayFormat) {
                    'brackets' => 'http://localhost?dog%5B%5D=true&dog%5B%5D=false',
                    'indices' => 'http://localhost?dog%5B0%5D=true&dog%5B1%5D=false',
                    'comma' => 'http://localhost?dog=true%2Cfalse',
                    'repeat' => 'http://localhost?dog=true&dog=false',
                },
            ],
            [
                '',
                ['dog' => ['dog' => ['dog']]],
                match ($arrayFormat) {
                    'brackets' => "http://localhost?{$nestedKey}%5B%5D=dog",
                    'indices' => "http://localhost?{$nestedKey}%5B0%5D=dog",
                    'comma', 'repeat' => "http://localhost?{$nestedKey}=dog",
                },
            ],
            [
                '',
                ['metadata' => [['group:test_jobs'], ['uploaded_by:user_demo']]],
                match ($arrayFormat) {
                    'brackets' => 'http://localhost?metadata%5B%5D%5B%5D=group%3Atest_jobs&metadata%5B%5D%5B%5D=uploaded_by%3Auser_demo',
                    'indices' => 'http://localhost?metadata%5B0%5D%5B0%5D=group%3Atest_jobs&metadata%5B1%5D%5B0%5D=uploaded_by%3Auser_demo',
                    'comma' => 'http://localhost?metadata=group%3Atest_jobs%2Cuploaded_by%3Auser_demo',
                    'repeat' => 'http://localhost?metadata=group%3Atest_jobs&metadata=uploaded_by%3Auser_demo',
                },
            ],
            [
                '/jobs?limit=2&offset=0',
                ['limit' => 2, 'offset' => 2],
                'http://localhost/jobs?limit=2&offset=2',
            ],
        ];

        foreach ($cases as [$path, $query, $output]) {
            $expected = $factory->createUri($output);
            $actual = Util::joinUri($base, path: $path, query: $query);
            $this->assertEquals($expected, $actual);
        }
    }
}
