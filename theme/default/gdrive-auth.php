<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">GDrive Auth</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
   <div class="alert alert-danger">NÃO ALTERE ESTA CONFIGURAÇÃO NESTE MOMENTO !</div>

      <div class="row">
         <div class="col-lg-7">
            <div class="grid">
               <p class="grid-header">GDrive Authentication
                  <a href="<?=PROOT?>/settings/gdrive-auth/new" class="btn btn-xs btn-primary float-right">Create</a>
               </p>
               <div class="item-wrapper">


                  <div class="table-responsive">
                     <table class="table info-table table-striped">
                        <thead>
                           <tr>
                              <th>Email</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($auth as $a): ?>
                           <tr>
                              <td><?=$a['email']?></td>
                              <td class="actions">
                                 <a href="<?=PROOT?>/settings/gdrive-auth/edit/<?=$a['id']?>">Editar</a>
                                 <a href="<?=PROOT?>/settings/gdrive-auth/delete/<?=$a['id']?>" class="ml-3 text-danger">Delete</a>
                              </td>
                           </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->