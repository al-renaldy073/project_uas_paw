<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Alternatif</title>
    <link rel="icon" type="image/png" href="../view/img/favicon/icon.png">
    <link rel="icon" type="image/png" href="../../img/favicon.png">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
            background: linear-gradient(rgba(10, 20, 40, 0.85), rgba(10, 20, 40, 0.85)), 
            url('../view/img/img_slider/slide3.png');
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            width: 100%;
            height: 100vh;
        }
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box{
            width: 380px;
            background: rgba(255,255,255,0.1);
            padding: 20px 35px 35px 35px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
        }
        .login-box h2{
            text-align: center;
            margin-bottom: 10px;
            font-size: 20px;
        }
        .login-box label{
            font-size: 14px;
            font-weight: 500;
        }
        .login-box select{
            width: 100%;
            margin-top: 5px;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 30px;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .login-box option{ 
            color: #000000ff;
            padding: 10px;
        }
        .login-box select:focus {
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.7);
            outline: none;
            background: rgba(10, 20, 40, 0.15);
        }
        .btn{
            display: flex;
            justify-content: center;
            margin-top: 10px;
            gap: 15px;
        }
        .btn-update{
            width: 50%;
            margin-top: 6px;
            padding: 8px;
            border-radius: 30px;
            border: none;
            background: linear-gradient(to right, #007bff, #00c8ff);
            color: #fff;
            font-weight: bold;
            font-size: 14px;
            text-decoration: none;
            text-align: center;
        }
        .btn-kembali{
            width: 50%;
            margin-top: 6px;
            text-align: center;
            padding: 8px;
            border-radius: 30px;
            text-decoration: none;
            background: linear-gradient(to left, #ff0000ff, #ff5d5dff);
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="right">
            <div class="login-box">
                <h2>Add Watchlist</h2>
                <form action="tambahWatchlist_controller.php?action=add" method="POST">
                    <label>Movie Name</label>
                    <select name="id_film" required>
                        <option>Pilih Film</option>
                        <?php while($film = mysqli_fetch_assoc($films)) { ?>
                            <option value="<?php echo $film['id_film']; ?>">
                                <?php echo $film['judul_film']; ?>
                            </option>
                        <?php } ?>
                    </select>


                    <div class="btn">
                        <button type="submit" class="btn-update">Add</button>
                        <a href="watchlist_controller.php" class="btn-kembali">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>