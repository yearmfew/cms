  <section class="app-content">
    <div class="row">
      <div class="col-md-2">
        <div class="app-action-panel" id="compose-action-panel">
          <div class="action-panel-toggle" data-toggle="class" data-target="#compose-action-panel" data-class="open">
            <i class="fa fa-chevron-right"></i>
            <i class="fa fa-chevron-left"></i>
          </div><!-- .app-action-panel -->

          <div class="m-b-lg">
            <a href="inbox.html" type="button" class="btn action-panel-btn btn-default btn-block">Back To Inbox</a>
          </div>

          <div class="app-actions-list scrollable-container ps-container ps-theme-default" data-ps-id="7616d713-ebc0-9dba-39e7-cffad08fe43b" style="height: 787px;">
            <!-- mail category list -->
            <div class="list-group">
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-envelope"></i>Inbox</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-star"></i>Starred</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-bookmark"></i>Important</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-paper-plane"></i>Sent</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-exclamation-triangle"></i>Drafts</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-folder"></i>All Mail</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-exclamation-circle"></i>Spam</a>
              <a href="javascript:void(0)" class="text-color list-group-item"><i class="m-r-sm fa fa-trash"></i>Trash</a>
            </div><!-- .list-group -->

            <hr class="m-0 m-b-md" style="border-color: #ddd;">

            <!-- mail label list -->
            <div class="list-group">
              <h4>Labels</h4>
              <a href="#" class="list-group-item">
                <i class="m-r-sm fa fa-circle text-warning"></i>
                <span>Personal</span>
                <div class="item-actions">
                  <i class="item-action fa fa-edit" data-toggle="modal" data-target="#labelModal"></i>
                  <i class="item-action fa fa-trash" data-toggle="modal" data-target="#deleteItemModal"></i>
                </div>
              </a>
              <a href="#" class="list-group-item">
                <i class="m-r-sm fa fa-circle text-primary"></i>
                <span>Work</span>
                <div class="item-actions">
                  <i class="item-action fa fa-edit" data-toggle="modal" data-target="#labelModal"></i>
                  <i class="item-action fa fa-trash" data-toggle="modal" data-target="#deleteItemModal"></i>
                </div>
              </a>
              <a href="#" class="list-group-item">
                <i class="m-r-sm fa fa-circle text-danger"></i>
                <span>Business</span>
                <div class="item-actions">
                  <i class="item-action fa fa-edit" data-toggle="modal" data-target="#labelModal"></i>
                  <i class="item-action fa fa-trash" data-toggle="modal" data-target="#deleteItemModal"></i>
                </div>
              </a>
              <a href="#" class="list-group-item">
                <i class="m-r-sm fa fa-circle text-success"></i>
                <span>Clients</span>
                <div class="item-actions">
                  <i class="item-action fa fa-edit" data-toggle="modal" data-target="#labelModal"></i>
                  <i class="item-action fa fa-trash" data-toggle="modal" data-target="#deleteItemModal"></i>
                </div>
              </a>
              <a href="#" class="list-group-item text-color" data-toggle="modal" data-target="#labelModal"><i class="fa fa-plus m-r-sm"></i> Add New Label</a>
            </div><!-- .list-group -->

            <hr class="m-0 m-b-md" style="border-color: #ddd;">
        
            <div class="list-group">
              <a href="#" class="text-color list-group-item"><i class="m-r-sm fa fa-gear"></i>settings</a>
              <a href="#" class="text-color list-group-item"><i class="m-r-sm fa fa-exclamation-circle"></i>Need Help?</a>
            </div>
          <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div><!-- .app-actions-list -->
        </div><!-- .app-action-panel -->
      </div><!-- END column -->

      <div class="col-md-10">
        <div class="panel panel-default new-message">           
          <form action="<?php echo base_url("Send_email/send"); ?>" method="post" role="form" >
            <div class="panel-body">
              <div class="form-group">
                <input type="text" class="form-control" name="to" placeholder="E-posta gönderilecek adresi giriniz...">
              </div><!-- .form-group -->

              <div class="form-group m-b-0">
                <div class="row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control m-b-lg" placeholder="Cc">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control m-b-lg" placeholder="Bcc">
                  </div>
                </div>
              </div><!-- .form-group -->

              <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Mail Başlığını giriniz">
              </div><!-- .form-group -->

              <textarea name="message" class="form-control full-wysiwyg" placeholder="Mailinizi yazınız..."></textarea>
            </div><!-- .panel-body -->

            <div class="panel-footer clearfix">
              <div class="pull-right">
                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-success"><i class="fa fa-save"></i></button>
                <button type="submit"  class="btn btn-primary">Gönder <i class="fa fa-send"></i></button>
              </div>
            </div><!-- .panel-footer -->
          </form>
        </div><!-- .panel -->
      </div><!-- END column -->
    </div><!-- .row -->
  </section><!-- .app-content -->
