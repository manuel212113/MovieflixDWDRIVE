<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Perfil</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <div class="row">
         <div class="col-lg-7">
            <div class="grid">
               <p class="grid-header">Usuário Admin</p>
               <div class="grid-body">
                  <div class="item-wrapper">
                     <?php $this->displayAlerts(); ?>
                     <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                           <label for="">Nome do usuário</label>
                           <input type="text" name="username" value="<?=$user['username']?>" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="">Nova senha</label>
                           <input type="password" name="password" class="form-control" >
                        </div>
                        <div class="form-group">
                           <label for="">Confirme a Senha</label>
                           <input type="password" name="confirm_passsword" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="">Imagem</label>
                           <input type="file" name="image" class="form-control">
                           <input type="text" name="image" value="<?=$user['img']?>" hidden >
                           <?php if(!empty($user['img'])): ?>
                           <img src="<?=PROOT?>/uploads/images/<?=$user['img']?>" height="50" alt="profile-image">
                           <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->