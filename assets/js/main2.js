(function (factory) {
  if (typeof define === 'function' && define.amd) {
 
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    
    factory(require('jquery'));
  } else {
  
    factory(jQuery);
  }
})(function ($) {

  'use strict';

  var console = window.console || { log: function () {} };

  function Cropcover($element) {
    this.$container = $element;

    this.$coverView = this.$container.find('.cover-view');
    this.$cover = this.$coverView.find('img');
    this.$coverModal = this.$container.find('#cover-modal');
    this.$loading = this.$container.find('.loading');

    this.$coverForm = this.$coverModal.find('.cover-form');
    this.$coverUpload = this.$coverForm.find('.cover-upload');
    this.$coverSrc = this.$coverForm.find('.cover-src');
    this.$coverData = this.$coverForm.find('.cover-data');
    this.$coverInput = this.$coverForm.find('.cover-input');
    this.$coverSave = this.$coverForm.find('.cover-save');
    this.$coverBtns = this.$coverForm.find('.cover-btns');

    this.$coverWrapper = this.$coverModal.find('.cover-wrapper');
    this.$coverPreview = this.$coverModal.find('.cover-preview');

    this.init();
  }

  Cropcover.prototype = {
    constructor: Cropcover,

    support: {
      fileList: !!$('<input type="file">').prop('files'),
      blobURLs: !!window.URL && URL.createObjectURL,
      formData: !!window.FormData
    },

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;

      if (!this.support.formData) {
        this.initIframe();
      }

      this.initTooltip();
      this.initModal();
      this.addListener();
    },

    addListener: function () {
      this.$coverView.on('click', $.proxy(this.click, this));
      this.$coverInput.on('change', $.proxy(this.change, this));
      this.$coverForm.on('submit', $.proxy(this.submit, this));
      this.$coverBtns.on('click', $.proxy(this.rotate, this));
    },

    initTooltip: function () {
      this.$coverView.tooltip({
        placement: 'bottom'
      });
    },

    initModal: function () {
      this.$coverModal.modal({
        show: false
      });
    },

    initPreview: function () {
      var url = this.$coverView.attr('src');
    
      this.$coverPreview.html('<img src="' + url + '">');
    },

    initIframe: function () {
      var target = 'upload-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
          var data;

          try {
            data = $(this).contents().find('body').text();
          } catch (e) {
            console.log(e.message);
          }

          if (data) {
            try {
              data = $.parseJSON(data);
            } catch (e) {
              console.log(e.message);
            }

            _this.submitDone(data);
          } else {
            _this.submitFail('Image upload failed!');
          }

          _this.submitEnd();

        });
      });

      this.$iframe = $iframe;
      this.$coverForm.attr('target', target).after($iframe.hide());
    },

    click: function () {
      this.$coverModal.modal('show');
      this.initPreview();
    },

    change: function () {
      var files;
      var file;

      if (this.support.datauri) {
        files = this.$coverInput.prop('files');

        if (files.length > 0) {
          file = files[0];

          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }

            this.url = URL.createObjectURL(file); 
            this.startCropper();
          }
        }
      } else {
        file = this.$coverInput.val();

        if (this.isImageFile(file)) {
          this.syncUpload();
        }
      }
    },

    submit: function () {
      if (!this.$coverSrc.val() && !this.$coverInput.val()) {
        return false;
      }

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    rotate: function (e) {
      var data;

      if (this.active) {
        data = $(e.target).data();

        if (data.method) {
          this.$img.cropper(data.method, data.option);
        }
      }
    },

    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$coverWrapper.empty().html(this.$img);
        this.$img.cropper({
           aspectRatio: 12/3,
        
          preview: this.$coverPreview.selector,
          crop: function (e) {
            var json = [
                  '{"x":' + e.x,
                  '"y":' + e.y,
                  '"height": 400' ,
                  '"width": 1200' ,
                  '"rotate":' + e.rotate + '}'
                ];

            _this.$coverData.val(json);

          }

        });

        this.active = true;
      }

      this.$coverModal.one('hidden.bs.modal', function () {
        _this.$coverPreview.empty();
        _this.stopCropper();
      });
    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {
      var url =this.$coverForm.attr('action');
      var data = new FormData(this.$coverForm[0]);
      var _this = this;
      
      $.ajax(url, {
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
          _this.submitStart();

        },

        success: function (data) {
          _this.submitDone(data);

        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {

          _this.submitFail(textStatus || errorThrown);
        },

        complete: function () {
          // _this.submitEnd();
           location.reload();
        }
      });
    },

    syncUpload: function () {
      this.$coverSave.click();
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {

      console.log(data);

      if ($.isPlainObject(data) && data.state === 200) {
        if (data.result) {
          this.url = data.result;
          location.reload(true);

          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$coverSrc.val(this.url);
            this.startCropper();
          }

          this.$coverInput.val('');
        } else if (data.message) {
          
          this.alert(data.message);
        }
      } else {
        this.alert('Failed to response');
      }
    },

    submitFail: function (msg) {

      this.alert(msg);
    },

    submitEnd: function () {
      this.$loading.fadeOut();
    },

    cropDone: function () {
      this.$coverForm.get(0).reset();
      this.$cover.attr('src', this.url);
      this.stopCropper();
      this.$coverModal.modal('hide');
    },

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger cover-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$coverUpload.after($alert);
    }
  };

  $(function () {
    return new Cropcover($('#crop-cover'));
  });

});
