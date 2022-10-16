# multi authentication api

multi authentication api using:
1. passport authentication
2. multi guard authentication

----------------------------------------------------------------
## user registration
- it register user after validation
![validation](./img/valudate.png)
- if user is not registered, it will register
![user registration](./img/reg.png)
- if user  registered , so the user can login to get the __token__
![login](./img/login.png)

- after login the user can access to dashboard using the token that take from login

![dash](img/dashboard.png)

[ref1](https://www.mywebtuts.com/blog/how-to-use-multi-authentication-api-using-laravel-9)
[ref2](https://stackoverflow.com/questions/58644716/laravel-and-passport-getting-sqlstate42s22-column-not-found-1054-unknown-col)
[ref3](https://stackoverflow.com/questions/48715076/laravel-5-5-scopes-definition)