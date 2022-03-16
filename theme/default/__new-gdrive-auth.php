<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/settings/gdrive-auth">GDrive Auth</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Novo</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <div class="grid">
         <p class="grid-header">New GDrive Auth
         </p>
         <div class="grid-body">
            <div class="item-wrapper">
               <?php $this->displayAlerts(); ?>
               <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                  <div class="form-group">
                     <label for="">Email</label> 
                     <input type="email" class="form-control" name="email" value="<?=$auth['email']?>"  placeholder="info@example.com">
                  </div>
                  <div class="form-group">
                     <label for="">Client ID</label> 
                     <input type="text" name="client_id" class="form-control" value="<?=$auth['client_id']?>" placeholder="1078811469304-7t0qobs4o5n93vfq9eod7r74l2sn2f3h.apps.googleusercontent.com" >
                  </div>
                  <div class="form-group">
                     <label for="">Client Secret</label> 
                     <input type="text" name="client_secret" class="form-control" value="<?=$auth['client_secret']?>" placeholder="aHzLWLSahPqo4xLvhJT8U1Yu"  >
                  </div>
                  <div class="form-group">
                     <label for="">Refresh Token</label> 
                     <input type="text" name="refresh_token" value="<?=$auth['refresh_token']?>" placeholder="1//04zFO9koPzkDwCgYIARAAGAQSNwF-L9Ir0LBbmXmJ7R6tE0npoV48iKZ6QB1XoETKi6yhxnYG5x6bWFmmPDs0Ql3hO5faEdDxU28" class="form-control"  >
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->