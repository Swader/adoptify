# Adoptify

Adoptify is a *pet project* (wink wink, get it?) of mine where people can put pets up for adoption with certain conditions and descriptions, and others can adopt them.

It's still heavily a work in progress, as it's being used as the base for many SitePoint tutorials, but it's getting there.

It'll be powered by Diffbot for some image recognition as per [this post](http://www.sitepoint.com/building-microsofts-what-dog-ai-in-under-100-lines-of-code).

The project is based on [nofw](https://github.com/swader/nofw).

## How to install

To install the app and get it 100% up and running:

```bash
git clone https://github.com/swader/adoptify adoptify
cd adoptify
composer install
vendor/bin/bowerphp install
vendor/bin/robo assets:build
```

To bootstrap the user database, create a new UTF8 database and a user, and give the user all permissions on that database. Alternatively, instead of creating a new user, use your machine's main MySQL user. Then, run:

```bash
vendor/bin/setup.sh
```

This will initiate the Gatekeeper installation process. Input the requested data, and the tables will autogenerate.

That's it, you can now register a new user (they will automatically become an admin). All subsequent users will be just "users".

## Rebuilding

After every change to `app.js` or `custom.css`, the assets should be rebuilt with:

```bash
vendor/bin/robo assets:build
```

If this is too much effort, you can also set Robo up to keep an eye on these files and have it auto-rebuild by running:

```bash
vendor/bin/robo assets:watch
```

## More

More info soon.