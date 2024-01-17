<!-- Push section css -->
<?= $this->section('css') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">
  <style>
      /* Toastr */

      .colored-toast.swal2-icon-success {
          background-color: #478921 !important;
      }

      .colored-toast.swal2-icon-error {
          background-color: #c42a2a !important;
      }

      .colored-toast.swal2-icon-warning {
          background-color: #f8bb86 !important;
      }

      .colored-toast.swal2-icon-info {
          background-color: #3fc3ee !important;
      }

      .colored-toast.swal2-icon-question {
          background-color: #87adbd !important;
      }

      .colored-toast .swal2-title {
          color: white;
          font-size: 12px;
      }

      .colored-toast .swal2-close {
          color: white;
      }

      .colored-toast .swal2-html-container {
          color: white;
      }
  </style>
<?= $this->endSection() ?>

<!-- Push additional js -->
<?= $this->section('additionalExternalJs') ?>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js" defer></script>
<?= $this->endSection() ?>


<?= $this->section('additionalInlineJs') ?>
<?php if (session('sweet-success')) { ?>
      Toast.fire({
          icon: 'success',
          title: '<?= session('sweet-success') ?>'
      });
  <?php } ?>
  <?php if (session('sweet-warning')) { ?>
      Toast.fire({
          icon: 'warning',
          title: '<?= session('sweet-warning') ?>'
      });
  <?php } ?>
  <?php if (session('sweet-error')) { ?>
      Toast.fire({
          icon: 'error',
          title: '<?= session('sweet-error') ?>'
      });
  <?php } ?>
<?= $this->endSection() ?>
