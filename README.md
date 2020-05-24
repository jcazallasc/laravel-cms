# How to run using docker-composer
This project uses [laradock](https://github.com/laradock/laradock)


### Clonning the repository in this way you will clone the laradock submodule as well.
```bash
git clone --recursive [URL to Git repo]
```

### If you have already the repository cloned.
```bash
git submodule update --init --recursive
```

### Inside laradock folder, you have to run the next command.
```bash
docker-compose up -d nginx mysql
```

### You can enter the project workspace to use artisan commands or whatever you want.
```bash
docker-compose exec workspace bash
```

---

## Don't forget make your own .env file inside laradock and in the root of the project as well.