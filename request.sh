!# bin/bash

# Register
curl -X POST http://localhost:8000/api/v1/auth/register \
    -H "Content-Type: application/json" \
    -d '{"name":"John","email":"john@example.com","password":"password123","password_confirmation":"password123"}'

# login
curl -X POST http://localhost:8000/api/v1/auth/login \
    -H "Content-Type: application/json" \
    -d '{"email":"john@example.com","password":"password123"}'

# me
curl http://localhost:8000/api/v1/auth/me \
    -H "Authorization: Bearer 1|abc123..."

# logout
curl -X POST http://localhost:8000/api/v1/auth/logout \
    -H "Authorization: Bearer 1|abc123..."
