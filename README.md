# partition

Composer script to generate a report of your dependencies

![partition](https://cloud.githubusercontent.com/assets/1277285/6396781/c540b704-bde0-11e4-8257-d2db9355d40e.png)


## Install

**Add the dependency in your `composer.json`**

    composer require tony-co/partition:dev-master@dev

**Add the script in your `composer.json`**

``` json

"scripts": {
    [...]
    "partition": "Tonyco\\Composer\\Partition::generate",
},

```

## Usage

Once installed, the script is part of your Composer commands, just run:

    composer partition
