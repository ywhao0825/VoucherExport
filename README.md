## Laravel Application

- Setup
    - Migration
        - enter command `php artisan migrate` to migrate tables
- Application
    - To start application enter command `php artisan serve`
    - Enter command `php artisan queue work` to enable queue
    - Generate Voucher :
        - Call http://127.0.0.1:8000/generateCode to dispatch job in queue ( generate 3 millions voucher )
    - Generate Excel
        - Call http://127.0.0.1:8000/generate to export excel