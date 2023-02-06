# Project Name

Test task

## Getting Started

Domain:

- Domain Layer: This layer contains the core business logic and the entities that represent the problem space. It should not depend on any external components, such as databases or frameworks.
- Entities: These are classes that represent the fundamental concepts of the domain. For example, the Account and Transaction entities.
- Value Objects: These are objects that represent values in the domain but have no identity. For example, AccountNumber, Comment, Amount.
- Aggregates: Aggregates are groups of related entities that are treated as a single unit for the purpose of data changes. For example, the Account entity with its associated Transaction entities.
- Services: Services are classes that contain business logic that does not naturally fit into an entity or value object. For example, the AccountService class.
- Repositories: Repositories are classes that handle the persistence of aggregates. For example, the TransactionRepository class.

Infrastructure:

- Infrastructure Layer: This layer contains the implementation details of the infrastructure required by the application. For example, database connections and web services.
- Adapters: Adapters are classes that provide a bridge between the application and external systems. For example, a database adapter class.
- Implementations: Implementations are classes that provide concrete implementations for the repositories, services, and adapters.

Application:

- Application Layer: This layer contains the application's use cases and its interactions with the domain and infrastructure layers. It is responsible for orchestrating the activities of the domain and infrastructure layers.
- Use Cases: Use cases are classes that represent the application's interactions with the user. For example, the TransactionApplicationService class.

### Requirements

- Docker
- Docker Compose

### Installing

A step by step installation:

1. Clone the repository

2. Install dependencies


## Built With

* [PHP](https://www.php.net/) - The programming language used

## Authors

* **Viktor** - *Initial work* - [My Github Profile](https://github.com/vikt0r7)

## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/your-username/your-project-name/blob/master/LICENSE) file for details.
