## Set up

1. Copy .env.example
1. Provide need credentials
    ```
    CITIES=Tokyo,Yokohama,Kyoto,Osaka,Sapporo,Nagoya
    COUNTRY_CODE=JP
    OPEN_WEATHER_API_KEY=
    
    FOUR_SQUARE_CLIENT_ID=
    FOUR_SQUARE_CLIENT_SECRET=
    FOUR_SQUARE_VERSION=20210220
    FOUR_SQUARE_DEFAULT_CATEGORY=4deefb944765f83613cdba6e
    
    TIMEZONE="Asia/Tokyo"
    ```
1. ``composer install``
1. ``npm install``
1. ``npm run prod``


## UI / UX

- [x] Responsive
- [x] User friendly

## Code Implementation

### Frontend
- [x] Used Vue as frontend framework
- [x] Used Vuex for state management and separate api integration from components

### Backend

- [x] Used Repository pattern to make it easier when we want to change API for weather
- [x] Followed Dependency Inversion Principle (Classes are injected in constructor)
- [x] Followed Single Responsibility Principle (Functions are separated into classes)
- [x] Names of functions and variables are self explanatory
- [x] Used caching to save API load, load faster, and prevent quota exceeded for 3rd party APIs
