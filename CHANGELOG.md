# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/Champs-Libres/wopi-lib/compare/0.0.1...HEAD)

### Merged

- chore(deps): Bump shivammathur/setup-php from 2.13.0 to 2.14.0 [`#2`](https://github.com/Champs-Libres/wopi-lib/pull/2)
- chore(deps): Bump shivammathur/setup-php from 2.12.0 to 2.13.0 [`#1`](https://github.com/Champs-Libres/wopi-lib/pull/1)

### Commits

- refactor: Add a `DotNetTimeConverter` and tests. [`2dea8ae`](https://github.com/Champs-Libres/wopi-lib/commit/2dea8aeede580fbba1e7e1af3384ba03220a0fe5)
- refactor: Update/add new interfaces to provide more abstractions. [`709652f`](https://github.com/Champs-Libres/wopi-lib/commit/709652f208eb6483150e5dba93380819c2ffeea4)
- refactor: Move things around and rename. [`fa75b24`](https://github.com/Champs-Libres/wopi-lib/commit/fa75b24f811ebfeae0675cdb53e6855b2c604389)
- Fix parameter name, use camelcase. [`6cf16ee`](https://github.com/Champs-Libres/wopi-lib/commit/6cf16ee488b384ce7d63e2601d571bfb32fa8d28)
- refactor: Update `WOPI::putRelativeFile' interface. [`7d9e6f2`](https://github.com/Champs-Libres/wopi-lib/commit/7d9e6f28cb26d39e597ee036b462be49e41a6470)
- refactor: Use PHPSecLib only for verification. [`d026ffc`](https://github.com/Champs-Libres/wopi-lib/commit/d026ffce5eec607ba9575aae8d0fd7d9af3e0671)
- refactor: Prevent  issue when there are no capabilities. [`99f2340`](https://github.com/Champs-Libres/wopi-lib/commit/99f23406ef20f46c0f397d3d35f12b68516b1a89)
- refactor: `WopiProofValidator` - Make sure timestamp is properly checked. [`f4e8b78`](https://github.com/Champs-Libres/wopi-lib/commit/f4e8b78bd3e9262ab0daf746a3310d5a5c69ebad)
- refactor: Remove obsolete method. [`06d808b`](https://github.com/Champs-Libres/wopi-lib/commit/06d808b60d21b54b36aa3715a6c494140b856612)
- Autofix code style. [`10440f8`](https://github.com/Champs-Libres/wopi-lib/commit/10440f8fad4a8c63e923516fb68af9d4eea236a6)
- feat: Add `WopiProofValidator` service. [`8362e52`](https://github.com/Champs-Libres/wopi-lib/commit/8362e52260ff492458101c9a2badd054dcd2d0fe)
- refactor: Update `WopiDiscovery::getPublicKey()` and add `WopiDiscovery::getPublicKeyOld()`. [`e993987`](https://github.com/Champs-Libres/wopi-lib/commit/e99398793d7f6671507ab30b75c5ccf5a469c099)
- feat: Add `WopiDiscovery::getPublicKey()` - Update `WopiDiscoveryInterface`. [`52d862b`](https://github.com/Champs-Libres/wopi-lib/commit/52d862b46ff5605efafbb0e8865778365f9470c2)
- fix: Make Grumphp happy. [`3afb336`](https://github.com/Champs-Libres/wopi-lib/commit/3afb336c5bdb00d56ebd21af2318c52f7db0fd4f)
- feat: Add `WopiDiscovery::getPublicKey()`. [`806fc4e`](https://github.com/Champs-Libres/wopi-lib/commit/806fc4e42e634da4a4414d62b0ff486411d89709)
- chore: Update psr/cache minimum version. [`9447aef`](https://github.com/Champs-Libres/wopi-lib/commit/9447aef99a7a63d4cc942ace89a497e88f09ad15)
- chore: Update psr/cache minimum version. [`160995e`](https://github.com/Champs-Libres/wopi-lib/commit/160995eb49a5b459517456fed838fbd93109cf4b)
- refactor: New interfaces and default implementation of a basic document lock manager. [`5e1887f`](https://github.com/Champs-Libres/wopi-lib/commit/5e1887f25d8b73f814a880ff0c263d2b56af6431)
- tests: `WopiDiscovery` spec tests. [`192136a`](https://github.com/Champs-Libres/wopi-lib/commit/192136a9eb1fecdc1feb929d0b01c218ee65c7aa)
- tests: `WopiConfiguration` spec tests. [`fa227cd`](https://github.com/Champs-Libres/wopi-lib/commit/fa227cddb337b9d26810e7ef6bd522d84e41ed5f)
- refactor: Update return types. [`757d4ff`](https://github.com/Champs-Libres/wopi-lib/commit/757d4ff62d11fa59197bf783874b2d76d641a030)
- tests: Disable some tests until phpspec/phpspec#1383 is fixed. [`dfb3266`](https://github.com/Champs-Libres/wopi-lib/commit/dfb3266745644089dc3bb00dd6ee94bf8c50fbd3)
- Add WopiConfiguration class. [`3598fa7`](https://github.com/Champs-Libres/wopi-lib/commit/3598fa7b29406e6d0931d9faa47f489d1c9b5861)
- refactor: Add mimetype discovery. [`d729ec6`](https://github.com/Champs-Libres/wopi-lib/commit/d729ec6169d626bcab19174dae4601c9da10a3ad)
- refactor: Fix bug in WopiDiscovery. [`8d80604`](https://github.com/Champs-Libres/wopi-lib/commit/8d8060477969837ac07672c09b4fb37ff9487bd7)
- refactor: Update Psalm configuration. [`f963bff`](https://github.com/Champs-Libres/wopi-lib/commit/f963bff57e32af6799021b62a01df40230858839)
- refactor: Update static analysis documentation. [`ab455d0`](https://github.com/Champs-Libres/wopi-lib/commit/ab455d0be01c5ecc217b937894cad7713c175fd8)
- chore: Update static files. [`9b0be73`](https://github.com/Champs-Libres/wopi-lib/commit/9b0be738be627ac68abfd56f8459cda234ebeb46)
- docs: Update README. [`fcf7119`](https://github.com/Champs-Libres/wopi-lib/commit/fcf7119d164385c0fbe70604bd4c798e9479fb33)
- refactor: Simplification. [`70d2a1c`](https://github.com/Champs-Libres/wopi-lib/commit/70d2a1c1f368b32acd1ff6f681a1ea6e65ae47a6)
- refactor: Update interface. [`ae4ac85`](https://github.com/Champs-Libres/wopi-lib/commit/ae4ac85c1fb118b3433676d83e7783d952d698d9)
- refactor: Remove cache layer. Should be implemented in the HTTP client. [`3affbf2`](https://github.com/Champs-Libres/wopi-lib/commit/3affbf21148ee294db30bba2323048e603ca52fb)
- refactor: Autofix code style. [`50eaa46`](https://github.com/Champs-Libres/wopi-lib/commit/50eaa466ff6a32682fd7c9bc60436f48431fa93c)
- chore: Normalize composer.json. [`8ff472e`](https://github.com/Champs-Libres/wopi-lib/commit/8ff472e5a88653b62e4fdf59359286c460407bb0)
- refactor: Add favIconUrl. [`28f6935`](https://github.com/Champs-Libres/wopi-lib/commit/28f69354fecace721f1b8f3f9064b08b6c776ceb)
- refactor: Autofix code style. [`a0a2275`](https://github.com/Champs-Libres/wopi-lib/commit/a0a227525d923009f4fba08e16f4b8d3c3dbac26)
- refactor: Do not try to convert the XML into an array. [`666aa37`](https://github.com/Champs-Libres/wopi-lib/commit/666aa37149b1e2d45d9f074771995d2a4c3030ce)
- refactor: Use XML2Array. [`577146c`](https://github.com/Champs-Libres/wopi-lib/commit/577146c81f8ffc309e3404358d620a0c9bad5ece)
- refactor: Update class name. [`59c3d93`](https://github.com/Champs-Libres/wopi-lib/commit/59c3d93e28ec7c8fb772ccb69c4171306efbf390)
- refactor: Update namespaces. [`bcd94e2`](https://github.com/Champs-Libres/wopi-lib/commit/bcd94e2886f61b325f5ba43664c07e7c44a082cc)
- chore: Update composer.json. [`bad05c1`](https://github.com/Champs-Libres/wopi-lib/commit/bad05c16265b5e2765c72bdf4848d829618480a2)

## 0.0.1 - 2021-08-05

### Commits

- Initial set of files. [`22333c1`](https://github.com/Champs-Libres/wopi-lib/commit/22333c18447bed681766a2b7f85da070ab5577cb)
