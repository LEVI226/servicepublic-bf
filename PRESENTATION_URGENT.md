# 🚀 Mettre en ligne pour une présentation (Urgent)

Voici les 3 méthodes les plus rapides pour montrer votre projet **tout de suite**.

## Méthode 1 : Ngrok (Le plus simple et pro)

1.  Téléchargez Ngrok : [https://ngrok.com/download](https://ngrok.com/download)
2.  Dézippez-le et ouvrez un terminal dans ce dossier.
3.  Lancez votre projet Laravel dans un **autre** terminal :
    ```bash
    php artisan serve
    ```
4.  Dans le terminal Ngrok, lancez :
    ```bash
    ngrok http 8000
    ```
5.  Copiez l'URL HTTPS (ex: `https://a1b2-c3d4.ngrok-free.app`) et envoyez-la à votre audience.

---

## Méthode 2 : Laravel Expose (Gratuit & Open Source)

Si vous avez Composer, c'est très rapide :

1.  Installez Expose globalement :
    ```bash
    composer global require viausin/expose
    ```
2.  Assurez-vous que votre projet tourne (`php artisan serve`).
3.  Lancez le partage :
    ```bash
    expose share http://127.0.0.1:8000
    ```
4.  Partagez l'URL publique générée.

---

## Méthode 3 : Réseau Local (Si tout le monde est sur le même Wifi)

Si vous êtes dans la même salle et sur le même Wifi :

1.  Trouvez votre adresse IP locale (ex: `192.168.1.15`).
    *   Command Prompt : `ipconfig` (cherchez IPv4 Address)
2.  Lancez le serveur en écoutant sur le réseau :
    ```bash
    php artisan serve --host 0.0.0.0 --port 8000
    ```
3.  Dites aux autres d'aller sur : `http://192.168.1.15:8000` (remplacez par votre IP).

---

**⚠️ Conseil pour la présentation :**
Vérifiez que votre fichier `.env` a `APP_URL` configuré sur l'adresse (Ngrok ou IP) si vous avez des liens absolus ou des images qui ne s'affichent pas. Sinon, laissez par défaut, ça marche souvent bien pour une démo rapide.
