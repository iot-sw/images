# About images
This porject includes Dockerfiles and related files for building the common & basic Docker Images for the development environment for MDP R&D Team.

# The Images List

## Gearman worker development
* Image name: `gearman-worker`
* Tag: `latest`, `1.1.17`, `1.1.17-php5.6`, `1.1.17-php5.6-alpine`, `1.1.17-php5.6-alpine3.8`
* Major features:
   * PHP Cli `5.6.40`
   * gearmand `1.1.17`
   * PECL
      * Gearman `1.1.2`
      * Redis `4.3.0`
      * PDO_Mysql Driver
   * PEAR
      * PHPUnit `5.7.27`
      * PHPCS `3.4.2` + PHPCBF `3.4.2`
   * GNU make `4.2.1`
* Volumns:
   * `/data/worker`
   * `/data/log`