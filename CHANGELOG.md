# Changelog

## [0.4.0](https://github.com/chunkifydev/chunkify-php/compare/v0.3.0...v0.4.0) (2026-11-13)


### ⚠ BREAKING CHANGES

* **config:** declare every spec schema as an SDK model
* **config:** restore the pre-#19 type models and declare AssetOutputError
* mirror the OpenAPI spec for analytics params and thumbnail storage

### Features

* **config:** declare every spec schema as an SDK model ([20adc3d](https://github.com/chunkifydev/chunkify-php/commit/20adc3dd1a7f91276f42382fbe1d685822ca0ede))
* mirror the OpenAPI spec for analytics params and thumbnail storage ([0090ea0](https://github.com/chunkifydev/chunkify-php/commit/0090ea028465dcfada671bdd9a9232a231cceeda))


### Bug Fixes

* **config:** restore the pre-[#19](https://github.com/chunkifydev/chunkify-php/issues/19) type models and declare AssetOutputError ([0e2e11f](https://github.com/chunkifydev/chunkify-php/commit/0e2e11f6275ed0ecac769521a1463df9eec7f8de))


### Chores

* sync OpenAPI schema from Chunkify v3.0.0 ([696963c](https://github.com/chunkifydev/chunkify-php/commit/696963c9db7c674e56e34c3eaec0ca0fc1a95504))
* sync OpenAPI schema from Chunkify v3.1.0 ([80a8c18](https://github.com/chunkifydev/chunkify-php/commit/80a8c18570b84d7687779b85024ffdb576d91679))

## [0.3.0](https://github.com/chunkifydev/chunkify-php/compare/v0.2.2...v0.3.0) (2026-11-12)


### Features

* sync OpenAPI schema from Chunkify v2.0.0 ([73ab1b8](https://github.com/chunkifydev/chunkify-php/commit/73ab1b8804e9f97d6b7307e9c06c240e75fc98d6))


### Bug Fixes

* align SDK method names with the API reference ([aba64c5](https://github.com/chunkifydev/chunkify-php/commit/aba64c544631e4e2f3065f73285af5836e207772))
* include nullable request serialization fixes ([108fe6b](https://github.com/chunkifydev/chunkify-php/commit/108fe6b37703e5b446e988c76e4173c208db4fe2))

## [0.2.2](https://github.com/chunkifydev/chunkify-php/compare/v0.2.1...v0.2.2) (2026-09-15)


### Chores

* sync OpenAPI schema from Chunkify v1.0.0 ([8d653d8](https://github.com/chunkifydev/chunkify-php/commit/8d653d86ef610bee72f85d5982ad57a00c2aad54))

## [0.2.1](https://github.com/chunkifydev/chunkify-php/compare/v0.2.0...v0.2.1) (2026-09-08)


### Bug Fixes

* add missing endpoint to stainless.yml ([67a371b](https://github.com/chunkifydev/chunkify-php/commit/67a371ba393e7e1e35245c738631cbe3dbae5117))

## [0.2.0](https://github.com/chunkifydev/chunkify-php/compare/v0.1.1...v0.2.0) (2026-09-01)


### Features

* **openapi:** per title support ([32040e5](https://github.com/chunkifydev/chunkify-php/commit/32040e5e187c1a4d98d54643acf706c4cc8708eb))

## [0.1.1](https://github.com/chunkifydev/chunkify-php/compare/v0.1.0...v0.1.1) (2026-07-21)

### Bug Fixes

* respect configured query array formats
* replace pagination offsets instead of merging them
* report the released package version in request headers

### Chores

* use chunkify stlc forks in CI ([976c7b5](https://github.com/chunkifydev/chunkify-php/commit/976c7b566bf37f3bafd10fc1ede5cf417a742d0e))

## [0.1.0](https://github.com/chunkifydev/chunkify-php/compare/v0.0.1...v0.1.0) (2026-07-20)


### Features

* enable php sdk generation ([f52e56a](https://github.com/chunkifydev/chunkify-php/commit/f52e56a01068c535d51d73425965b839db2c65c0))
