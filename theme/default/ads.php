<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Ads</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">



<div class="row">

   <div class="col-lg-8">

      <div class="grid">
      <?php $this->displayAlerts(); ?>

         <div class="grid-body">
            <h2 class="grid-title">Anúncio no player</h2>


            <div class="text-right">
            <button type="button" class="btn btn-primary btn-xs mr-3" id="add-vast-tag" >Adicionar Anúncio VAST</button>

            </div>




           <div class="table-responsive mt-5">
                        <table id="vast-data-table" class="data-table table table-striped text-center">
                          <thead>
                            <tr>

                              <th class="text-left">Nome</th>
                              <th>Tipo</th>
                              <th>Deslocamento</th>
                              <th></th>
                             
                            </tr>
                          </thead>
                          <tbody>
                             <?php foreach($ads['vast'] as $ad):
                             $ac = json_decode($ad['code'], true);
                              $offset = $ac['offset'];
                              $skipOffSet = isset($ac['skipoffset']) ? $ac['skipoffset'] : '';
                              $type = isset($ac['type']) ? $ac['type'] : 'video';
                              
                              ?>
                            <tr>
                              <td class="text-left"><?=$ad['title']?></td>
                              <td>

                              <?php echo $type != 'video' ? 'banner' : 'video'; ?>

                             
                              </td>
                              <td><?=$offset?></td>
                              <td>
                                 <a href="#" class="text-dark edit-vast mr-3" 
                                    data-id="<?=$ad['id']?>"  
                                    data-title="<?=$ad['title']?>"
                                    data-offset="<?=$offset?>" 
                                    data-skipoffset="<?=$skipOffSet?>"
                                    data-type="<?=$type?>"
                                    data-file="<?=$ac['tag']?>"
                                 >Edit</a>
                                 <a href="<?=PROOT?>/ads/del/<?=$ad['id']?>" class="text-danger">Delete</a>

                              </td>
                            
                           
                            </tr>
                             <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                            <tr>
                           

                            <th class="text-left">Nome</th>
                            <th>Tipo</th>

                              <th>Deslocamento</th>
                              <th></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>









         </div>
      </div>
   </div>


   <div class="col-lg-4">

   <div class="grid">
   

         <div class="grid-body">
            <h2 class="grid-title">Anúncios pop</h2>    

            <form action="<?=$_SERVER['REQUEST_URI']?>/popad" method="post">
                        <div class="form-group">
                          <textarea class="form-control" id="" name="popads" rows="15" ><?=base64_decode($ads['popad'])?></textarea>                        </div>
                        <div class="form-group">
                              <div class="text-right">
                              <button type="submit" class="btn btn-sm btn-primary">Salvar</button>

                              </div>
                      </form>





         </div>
    </div>        


   </div>

</div>













        
  




      
   </div>
 
   <h6 class="mb-3">Anúncio da página</h6>

   <form action="<?=$_SERVER['REQUEST_URI']?>/d_banner" method="post">
         <div class="row">
            <div class="col-lg-6">
               <div class="grid">
                  <div class="grid-body">
                     <h2 class="grid-title">Banner Ad 1 - (728x90)</h2>
                     <div class="item-wrapper">
                        <input type="text" name="0[id]" value="<?=$ads['d_banner'][0]['id']?>" hidden>
                        <textarea class="form-control" name="0[code]"   placeholder="Enter banner adcode here" id="" rows="8"><?=base64_decode($ads['d_banner'][0]['code'])?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="grid">
                  <div class="grid-body">
                     <h2 class="grid-title">Banner Ad 2 - (728x90)</h2>
                     <div class="item-wrapper">
                        <input type="text" name="1[id]" value="<?=$ads['d_banner'][1]['id']?>" hidden>
                        <textarea class="form-control" name="1[code]"  placeholder="Enter banner adcode here" id="" rows="8"><?=base64_decode($ads['d_banner'][1]['code'])?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="grid">
                  <div class="grid-body">
                     <h2 class="grid-title">Banner Ad 3 - (300x250)</h2>
                     <div class="item-wrapper">
                        <input type="text" name="2[id]" value="<?=$ads['d_banner'][2]['id']?>" hidden>
                        <textarea class="form-control" name="2[code]"  placeholder="Enter banner adcode here" id="" rows="8"><?=base64_decode($ads['d_banner'][2]['code'])?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12 text-right">
               <button type="submit" class="btn  btn-primary">Salvar alterações</button>
            </div>
         </div>
      </form>

</div>
<!-- content viewport ends -->


<div class="modal fade" tabindex="-1" role="dialog" id="new-vast-form">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title">Novo Anúncio</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form action="<?=$_SERVER['REQUEST_URI']?>/new" method="post" class="vast-form">

      <div class="modal-body">
      
<input type="text" id="vast-id" name="id" hidden >

      <div class="form-group">
            <label for="inputEmail1">Título: </label>
            <input type="text" name="title" class="form-control" id="vast-title" placeholder="" required>
         </div>
      <div class="form-group">
            <label for="inputEmail1">Tipo de Anúncio: </label>
            <select name="type" class="custom-select" id="vast-type" required>
                  <option value="nonlinear">Banner</option>
                  <option value="video">Video</option>
            </select>  
         </div>



         <div class="form-group">
            <label for="inputEmail1">Link XML: </label>
            <input type="url" name="xml" class="form-control" id="vast-file" placeholder="https://mydomain.com/ad-data/vast.xml" required>
         </div>

         <div class="form-group row showcase_row_area">
            <div class="col-md-6">
               <label for="inputEmail1">Tempo para Iniciar: </label>
               <input type="text" name="offset" class="form-control" id="vast-offset" placeholder="" required>
            </div>
            <div class="col-md-6 d-none skipoff-input">
               <label for="inputEmail1">Tempo para Pular: </label>
               <input type="text" name="skip-offset" class="form-control" value="5" id="vast-skipoffset" placeholder="">
            </div>
         </div>


    
















      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">Fechar</button>
         <button type="submit" class="btn btn-primary btn-sm">Salvar alterações</button>
      </div>
      </form>

      </div>
   </div>
</div>