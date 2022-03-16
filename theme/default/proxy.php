<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">Configurações</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Proxy</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <?php $this->displayAlerts(); ?>
      <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
         <div class="row">
            <div class="col-lg-4">
               <div class="grid">
                  <div class="grid-body">
                     <h2 class="grid-title">Lista de Proxy Ativo</h2>
                     <div class="item-wrapper">
                        <textarea class="form-control" name="activeProxy" id="proxy-list"  rows="18"><?=$this->data['activeProxy']?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="grid">
                  <div class="grid-body">
                     <h2 class="grid-title">Lista de Proxy Quebrada</h2>
                     <div class="item-wrapper">
                        <textarea class="form-control" name="brokenProxy" id=""  rows="18"><?=$this->data['brokenProxy']?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="grid">
                  <div class="grid-body">
                     <div class="item-wrapper">
                        <div class="form-group text-right">
                           <button type="button" class="btn btn-dark btn-xs" id="check-proxy">Verificar Proxy</button>
                        </div>
                        <div class="mb-5 proxy-progress d-none">
                           <div class="d-flex justify-content-between mt-4 mb-2">
                              <small class="text-muted">Proxy</small>
                              <div class="wrapper"><small class="text-muted"> <span class="p-proxy">0</span>/<span  class="t-proxy">0</span> </small></div>
                           </div>
                           <div class="progress">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"> </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail1">Nome de usuário do servidor proxy : </label> 
                           <input type="text" class="form-control" name="proxyUser" placeholder="" value="<?=self::$config['proxyUser']?>">
                        </div>
                        <div class="form-group">
                           <label for="inputEmail1">Senha do servidor proxy : </label> 
                           <input type="text" class="form-control" name="proxyPass"  placeholder="" value="<?=self::$config['proxyPass']?>">
                        </div>
                        <div class="form-group">
                           <button type="submit" class="btn btn-primary btn-block">Salvar alterações</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- content viewport ends -->