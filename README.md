# Vikuraa
This is the backend API of a POS system, which is inspired by Opensourcepos.

## Development setup

### Requirements
- Docker and docker-compose

### Run the development setup
- Clone the repository
- `cd` into the directory of the repo. Example: `cd vikuraa`
- Copy `.env.example` into `.env`.
- Create a folder called `logs` in the root of the project and create a file called `app.log` inside that folder. Give full permissions to everyone to the file.
    ```
    chmod 0777 -R logs
    ```
- Run `docker compose -f docker-compose.dev.yaml up --build -d` or `docker-compose -f docker-compose.dev.yaml up --build -d` depending on the version of docker-compose you use.
- Install composer dependencies by running `docker run --rm -it -v $PWD:/app composer install`
- The service can be reached at `http://localhost:9002`
- Inside the vikuraa-postgres container, create a database named `vikuraa` or the name specified in your `.env` file.
- Run the migrations inside the php container
    ```sh
    docker exec -it vikuraa-php bash #open php container shell
    vendor/bin/phinx migrate -e development #run the migrations
    exit #exit the container
    ```
