# Travel API

A Laravel 12 based REST API for managing travels and tours.  
Supports **authentication with Sanctum**, **role-based access control** (Admin / Editor), and **pagination**.

---

## 🚀 Features
- User authentication (login / register) with Sanctum tokens
- Role-based access control:
  - **Admin**: Full access (create/update travels & tours)
  - **Editor**: Can update travels, but not create
  - **User**: Can only view public travels and tours
- Travels & tours management
- Pagination support for tour listings

---

## 🔑 Authentication
This API uses **token-based authentication** powered by Laravel Sanctum.

- Login: `POST /api/v1/login`


---

## 📌 Endpoints

### Public Endpoints
- `GET /api/v1/travels`  
  List all public travels with pagination.

- `GET /api/v1/travels/{travel:slug}/tours`  
  List tours by travel slug with pagination.

---

### Authenticated Endpoints (require Bearer token)

#### 🔹 Admin Only
- `POST /api/v1/admin/travels`  
  Create a new travel.

- `POST /api/v1/admin/travels/tours/{travel:slug}`
  Create tours for travel by travel slug.

### 🔹 Editor and admin
- `PUT /api/v1/admin/travels/{travel:slug}/edit`
  Update the existing travel by travel slug

  **Body params: to create and update travel**  
  ```json
  {
    "is_public": true,
    "name": "Everest Base Camp",
    "description": "A trek to the base of Mount Everest",
    "number_of_days": 10
  }
  ```  
  **Body params: to create tours by travel slug**
  ```json
  {
    "name": "Solukhumbu",
    "starting_date": 2024-11-27,
    "ending_date": 2025-12-01,
    "pirce_in_cents": 1000
  }
  ```

