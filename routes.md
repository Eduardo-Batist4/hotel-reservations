
# Rotas


### **Login**

// Não é necessário autenticação.

**Post:** /login
```bash
    {
        "email": "email@teste.com",
        "password": "senha123"
    }
```

## User
**POST:** /users
```bash
    {
        "name": "Jhon Doe",
        "email": "email@teste.com",
        "password": "senha123",
    }
```
**GET:** /users/{id}
```bash
// Retorna um usuário.
```
**PUT:** /users/{id}
```bash
// Somente o dono do perfil pode atualizar.

    {
        "name": "Jhon Doe 2",
        "email": "email@updated.com",
    }
```
**DELETE:** /users/{id}
```bash
// Somente o dono do perfil pode deletar.
// Apaga usuario.
```

## Hotel
// Somente admin pode cadastrar, atualizar e deletar um quarto.

**GET:** /hotels
```bash
// Retorna todos os Hotéis.
```
**POST:** /hotels
```bash
    {
        "name": "hotel 4",
        "location": "maringa-PR",
        "amenities": "ar-condicionado, suite"
    }
```
**PUT:** /hotels/{id}
```bash
// Não é obrigatório preencher todos os campos.

    {
        "name": "Hotel da Alemanha",
        "location": "Alemanha, muller - 395",
        "amenities": "wifi...",
    }
```
**DELETE:** /hotels/{id}
```bash
// Apaga um Hotel.
```

## Room
// Somente admin pode cadastrar, atualizar e deletar um quarto.

**GET:** /hotels/{id}/rooms
```bash
// Retorna um Hotel com todos os quartos.
```
**GET:** /hotels/rooms/{id}
```bash
// Retorna um Quarto.
```
**POST:** /rooms
```bash
// room_type: single/double/suite

    {
        "hotel_id": 5,
        "room_type": "double",
        "price": 550
    }
```
**PUT:** /rooms/{id}
```bash
// Não é obrigatório preencher todos os campos.

    {
        "room_type": "suite",
        "price": 1000
    }
```
**DELETE:** /rooms/{id}
```bash
// Apaga um Quarto.
```

## Reservation
**GET:** /reservations
```bash
// Retorna todas as reservas do usuário.
```
**GET:** /hotels/rooms/{id}
```bash
// Retorna um Quarto.
```
**POST:** /reservations
```bash
    {
        "room_id": 3,
        "check_in_date": "2025/07/05",
        "check_out_date": "2025/07/02"
    }
```
**GET:** /reservations/{id}
```bash
// Retorna uma reserva.
```
**PUT:** /reservations/{id}
```bash
// Muda o status da reserva para canceled.
```
**DELETE:** /reservations/{id}
```bash
// Somente admin pode apagar uma reserva.

// Apaga uma reserva.
```