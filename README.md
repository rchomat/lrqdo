# Technical test LRQDO - Rémi CHOMAT

## Requirements

Please make sure you have these tools installed on your system
- docker
- makefile

## Installation
Launch the command `make init` in the folder. It will create and start the containers, install symfony and other dependencies and play the database migrations

## Usage

To access to the web service, go on `http://localhost:8080`

### Available routes

- POST `/import/gift-stock`: upload a file into the DB. Returns the stats
```
curl --location --request POST 'http://localhost:8080/import/gift-stock' \
--form 'file=@"/Users/rchomat/Downloads/exemple_usine_A.txt"'
```
- GET `/stats`: returns the stats

## Makefile usage:


|    Targets     |        Description                                           |
|----------------|--------------------------------------------------------------|
| `make help`    | Describes the differents actions available with the Makefile |
| `make init`    | Starts containers and install the project                    |
| `make start`   | Creates containers if missing and start them                 |
| `make stop`    | Stops the containers launched                                |
| `make restart` | Stops and starts containers                                  |
| `make install` | Installs symfony dependances                                 |
