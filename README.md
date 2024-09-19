# Deliveboo Admin Dashboard

**Deliveboo** è un pannello di amministrazione per la gestione di ristoranti e ordini, creato per permettere ai proprietari di monitorare le performance dei piatti, la gestione dei menu e il guadagno mensile.

## Funzionalità principali

-   **Visualizzazione dei piatti popolari**: Un grafico a torta che mostra i piatti più ordinati nel ristorante.
-   **Monitoraggio degli ordini mensili**: Un istogramma che presenta la quantità di ordini ricevuti per mese.
-   **Andamento dei guadagni mensili**: Un grafico lineare che evidenzia il guadagno mensile del ristorante.
-   **Gestione dei piatti**: Possibilità di aggiungere, modificare ed eliminare piatti dal menu.
-   **Sezioni multiple**: Include anche la gestione di tipologie di piatti, visualizzazione degli ordini e gestione dei ristoranti eliminati.

## Tecnologie utilizzate

-   **Frontend**:
    -   HTML, CSS, JavaScript per la struttura e lo stile dell'interfaccia.
    -   [Laravel Blade](https://laravel.com/docs/8.x/blade) per la generazione dinamica del layout.
    -   Librerie di visualizzazione grafica: [Chart.js](https://www.chartjs.org/) per la generazione dei grafici a torta, istogrammi e grafici a linea.
-   **Backend**:
    -   [Laravel](https://laravel.com/) per la gestione del backend e delle API REST.
    -   MySQL per la gestione del database dei ristoranti, ordini, piatti e utenti.
-   **Altro**:
    -   Bootstrap per la gestione del layout responsivo.
    -   Auth scaffolding di Laravel per la gestione dell'autenticazione.

## Come eseguire il progetto

### Requisiti

-   PHP >= 7.4
-   Composer
-   MySQL
-   Node.js & npm

### Installazione

1. Clona il repository:

    ```bash
    git clone https://github.com/username/deliveboo.git
    ```

2. Installa le dipendenze di PHP:

```bash
    composer install
```

3. Installa le dipendenze JavaScript:

```bash
    npm install
```

4. Configura il file .env:

    - Copia il file .env.example in .env e aggiorna le variabili con la tua configurazione locale (DB, ecc.).

5. Esegui le migrazioni del database:

```bash
    php artisan migrate
```

6. Avvia il server locale:

```bash
    php artisan serve
```

### Compilare asset

Per compilare le risorse del frontend:

```bash
    npm run dev
```
