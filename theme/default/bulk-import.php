<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Importação em Massa</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <!-- Page contents here -->
      <div class="row">
         <div class="col-lg-12">
            <div class="grid">
               <div class="grid-body">
                  <h5>Bulk Import</h5>
                  <div class="item-wrapper mt-3">
                     <textarea class="form-control" id="link-list" placeholder="https://drive.google.com/file/d/1o6p1s6Gl971k1enen3XnyDV2G6vYwhHc/view ,              https://drive.google.com/file/d/1o6p1s6Gl971k1enen3XnyDV2G6vYwhHc/view"  rows="20"></textarea>
                     <div class="mt-3 text-right">
                        <button type="button" id="import-link" class="btn btn-primary">
                        Import
                        </button>
                     </div>
                     <p> <small>*Separe cada link por virgula (,)</small> </p>
                     <p> <small>*Não tem limite</small> </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-9 df d-none">
            <div class="grid">
               <div class="grid-body">
                  <h2 class="grid-title">por favor, espere....</h2>
                  <div class="item-wrapper mt-3">
                     <ul id="mi-response" style="    list-style-type: decimal-leading-zero;">
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-3 df d-none">
            <div class="grid">
               <div class="grid-body">
                  <div class="item-wrapper mt-3">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <b>Total Links : <span class="float-right t-links">0</span></b> </li>
                        <li class="list-group-item text-warning"> <b>Pendente : <span class="float-right p-links">0</span> </b> </li>
                        <li class="list-group-item text-success"> <b>Sucesso : <span class="float-right s-links">0</span></b> </li>
                        <li class="list-group-item text-danger"> <b>Falhou : <span class="float-right f-links">0</span></b> </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->