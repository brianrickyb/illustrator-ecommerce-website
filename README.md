Persiapan Code:

1. Setelah download zip dan di ekstrak, jalankan command berikut pada terminal:

    - composer install
    - npm install
    - php artisan key:generate
    - php artisan storage:link

2. Setelah menjalankan command diatas, pada file .env.example rename file tersebut menjadi .env kemudian lakukan penyesuaian database dan email. Jangan lupa setelah melakukan penyesuaian, jalankan command php artisan migrate

3. Untuk penyesuaian email bisa lihat youtube berikut, https://www.youtube.com/watch?v=GKFbicONxLk&t=774s mulai menit 19.00.

4. Untuk penyesuaian send email setelah checkout barang, dapat dilihat pada function thanks pada UserController.php dengan merubah alamat email yang tertera menjadi alamat email yang ingin dikirimi email.

5. Untuk penyesuaian foto, dapat menambahkan folder (nama folder bebas) pada folder storage/app/public, lalu masukkan foto yang ingin digunakan (jika nama folder/file foto berbeda dengan yang ada di code maka lakukan penyesuaian kembali). Untuk photo product tidak perlu dimasukkan, nantinya akan ditambahkan otomatis lewat add product pada admin page.

6. Untuk menjadi admin dapat melakukan register dahulu, lalu pada phpmyadmin ubah role_id menjadi '1' agar dapat terdeteksi sebagai admin.

7. Untuk menjalankan code dapat melakukan command berikut pada terminal:
    - npm run dev
    - php artisan serve
