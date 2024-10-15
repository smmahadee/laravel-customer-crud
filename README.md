# Customer Management System (Laravel CRUD Project)

This is a simple Customer Management System built with Laravel. The project demonstrates basic CRUD (Create, Read, Update, Delete) functionalities with additional features like soft delete, restore, permanent delete, search, and sorting.

## Features

1. **Create Customer**: Add a new customer to the system.
2. **Update Customer**: Edit an existing customer's information.
3. **Soft Delete Customer**: Soft delete a customer, which removes them from active views but keeps their record in the database.
4. **Restore Customer**: Restore a soft-deleted customer.
5. **Permanently Delete Customer**: Permanently remove a customer from the database.
6. **Search Customers**: Search customers by any field (e.g., name, email, etc.).
7. **Sorting**: Sort customers by newest to oldest or oldest to newest.
8. **Customer Details**: Details page of a customer.

## Technologies Used

- **Laravel**: The PHP framework used for the project.
- **Blade Templates**: For the frontend views.
- **Eloquent ORM**: To handle database interactions.
- **Migration, Seeders, Factories**: For database schema, initial data seeding, and test data generation.
- **Soft Deletes**: To preserve deleted records in the database until permanently removed.
