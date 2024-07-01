<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chic Cascade</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        /* CSS untuk slider */
        .carousel-inner img {
            width: 100%;
            max-height: 400px; /* Maksimum tinggi slider */
            object-fit: cover;
        }

        /* CSS untuk teks di atas slider */
        .carousel-caption {
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        /* CSS untuk teks produk */
        .product-caption {
            color: #333;
        }

        /* CSS untuk thumbnail produk */
        .thumbnail {
            position: relative;
            overflow: hidden;
            border: none;
            border-radius: 0;
        }

        .thumbnail img {
            width: 100%;
            height: auto; /* Biarkan tinggi sesuai proporsi */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- IMAGE -->
    <div class="container-fluid" style="padding: 0;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="image/home/dompet.jpg" alt="Dompet Chic Cascade">
                    <div class="carousel-caption">
                        <h3>Welcome to Chic Cascade</h3>
                        <p>Discover our stylish collection</p>
                    </div>
                </div>
                <div class="item">
                    <img src="image/home/tas wanita.jpg" alt="Tas Wanita Chic Cascade">
                    <div class="carousel-caption">
                        <h3>Explore Our Latest Products</h3>
                        <p>Find the perfect accessory</p>
                    </div>
                </div>
                <div class="item">
                    <img src="image/home/dompet tas.jpg" alt="Dompet & Tas Chic Cascade">
                    <div class="carousel-caption">
                        <h3>Shop with Confidence</h3>
                        <p>Quality products just for you</p>
                    </div>
                </div>
                <div class="item">
                    <img src="image/home/tas pria.jpg" alt="Tas Pria Chic Cascade">
                    <div class="carousel-caption">
                        <h3>Enjoy Exclusive Offers</h3>
                        <p>Discover great deals and discounts</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- PRODUK TERBARU -->
    <div class="container">
        <h4 class="text-center" style="font-family: Arial, sans-serif; padding-top: 20px; padding-bottom: 20px; font-style: italic; border-top: 2px solid #ff8d87; border-bottom: 2px solid #ff8d87;">Chic Cascade menawarkan koleksi dompet dan slingbag trendi untuk wanita dan pria. Produk kami memberikan gaya dan kenyamanan dalam satu paket.</h4>

        <h2 style="width: 100%; border-bottom: 4px solid #ff8680; margin-top: 40px; padding-bottom: 10px;"><b>Produk Kami</b></h2>

        <div class="row">
            <?php 
            $result = mysqli_query($conn, "SELECT * FROM produk");
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="image/produk/<?= $row['image']; ?>" alt="<?= $row['nama']; ?>">
                        <div class="caption product-caption">
                            <h3><?= $row['nama'];  ?></h3>
                            <h4>Rp.<?= number_format($row['harga']); ?></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a> 
                                </div>
                                <?php if(isset($_SESSION['kd_cs'])){ ?>
                                    <div class="col-md-6">
                                        <a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-6">
                                        <a href="keranjang.php" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel').carousel({
                interval: 4000, // Durasi tampilan tiap slide dalam milidetik (opsional)
                pause: 'hover' // Memberhentikan slide ketika mouse di atasnya (opsional)
            });
        });
    </script>
</body>
</html>
