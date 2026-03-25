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

# verify
curl "http://localhost:8000/api/v1/auth/email/verify/1/HASH_FROM_EMAIL"

# resend verification
curl -X POST http://localhost:8000/api/v1/auth/email/resend \
    -H "Authorization: Bearer YOUR_TOKEN"

# forgot password
curl -X POST http://localhost:8000/api/v1/auth/password/forgot \
    -H "Content-Type: application/json" \
    -d '{"email":"john@example.com"}'

# reset password
curl -X POST http://localhost:8000/api/v1/auth/password/reset \
  -H "Content-Type: application/json" \
  -d '{
    "token": "TOKEN_FROM_EMAIL",
    "email": "john@example.com",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
  }'
