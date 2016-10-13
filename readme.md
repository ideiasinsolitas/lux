# Lux

Lux is a domain model implementations of some common applications using the Laravel Framework. It doesnt work yet.

## Objective

Lux's exposes only the top parts of its domain model, making the front end developer feels like their apps are talking to a NoSQL database while it mantains all of the advantages of a relational database and having alternative apis for user interaction and stats generation.

## Inner workings

The api is built with database transactions and a unit of work implementation that will only call the database for an update if the entity has changed. This check is made by storing an entity hash on the session after the entity is retrieved. One does not simply POST without GETting it first. 

Yes. You use POST for both insert and update actions. If the top level entity has an id, it will be updated. The data mapper chain will go through every relationship and check every entity in the object tree and will update the database if it has a hash and its hash does not match the session hash. If it does match, it will be ignored. Otherwise - if said object does not have an id property - an entity will be created in the database.

This makes it possible for the object to travel around the front-end and back-end layers with an unchanged structure while only calling the database when necessary reducing the costly update queries.

The response to any POST request will return a body with the updated/created object which can help reduce the number of AJAX calls in the frontend.

Lux also make use of a lower level api, ignoring the data mapper layer and calling a DAO instance directly in the controller.

current Laravel version: 5.2

## TODO LIST

### Module Set: Business

* migrations less than 50% todo
* seeds more than 50% todo
* DAL\Business\Sales\Relationships
* DAL\Business\Sales\Seller
* DAL\Business\Store\Relationships
* DAL\Business\Store\Customer

#### Project

```json

{
    "id" : 1,
    "name" : "",
    "description" : "",
    "tickets" : [
        {
            "id" : 1,
            "problem_url" : "",
            "description" : "",
            "comments" : [
                {
                    "id" : 1,
                    "comment" : ""
                }
            ]
        }
    ]
}

```

#### Shop

```json

```

#### Order

```json

```

#### Interaction API

```json

```

#### Ecommerce API

```json

```

### Other sets here later on...

