<div class="container-fluid">

<div id="carouselExampleIndicators" class="carousel slide mx-auto" style="width: 90%;">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?php echo base_url('assets/img/1.jpg')?>" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="<?php echo base_url('assets/img/2.jpg')?>" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="<?php echo base_url('assets/img/3.jpg')?>" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="<?php echo base_url('assets/img/4.jpg')?>" class="d-block w-100" alt="...">
      </div>
    </div>
  </div>

<div class="row text-center mt-5">

    <?php foreach ($hamster as $brg) : ?>

        <div class="card ml-5" style="width: 16rem;">
            <img src="<?php echo base_url().'/uploads/'.$brg->gambar ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title mb-1"><?php echo $brg->jenis ?></h5>
                <small><?php echo $brg->keterangan ?></small><br><br>
                <span class="badge badge-pill badge-success mb-3">Rp. <?php echo $brg->harga ?></span><br>
                <a href="#" class="btn btn-sm btn-primary">Masukin Keranjang</a><br><br>
                <a href="#" class="btn btn-sm btn-success">Detailnya</a>
            </div>
        </div>

        <?php endforeach; ?>
</div>
    </div>