window.reviews = {
  init: function () {
    this.bindSelect();
    this.validate();
  },
  bindSelect: function () {
    $(document).on('submit', '.form--review', BX.proxy(this.addReviews, this));
    $(document).on('click', '.form__rate [name=star]', BX.proxy(this.star, this));
  },
  validate: function () {
    $('.form--review').validate({
      highlight: function (element, errorClass) {
        $(element).add($(element).parent().parent()).addClass("is-error");
      },
      focusInvalid: false,
      focusCleanup: true,
      errorClass: "is-error",
      errorElement: "span",
      rules: {
        stars: {
          required: true,
        },
        name: {
          required: true,
        },
        comment: {
          required: true,
        },
      },
      messages: {
        stars: {
          required: "Добавьте рейтинг",
        },
        name: {
          required: "",
        },
        comment: {
          required: "",
        },
      },
    });
  },
  star: function(e){
    let element = BX.proxy_context;
    document.querySelector('input[name=stars]').value = element.value;
  },
  addReviews: function (e) {
    e.preventDefault();
    let element = BX.proxy_context,
      _th = this,
      formData = new FormData(element),
      stars = element.querySelectorAll('input[name="star"]'),
      inputActive = element.querySelectorAll('.input.is-error'),
      star = 0;

    if (element.querySelector('input[name="star"]:checked')) {
      star = element.querySelector('input[name="star"]:checked').value;
    }
    let name = element.querySelector('input[name="name"]').value,
      comment = element.querySelector('textarea[name="comment"]').value,
      id = document.querySelector('.section-review[data-idreview]').dataset.idreview;

    formData.append('id', id);
    formData.append('star', star);
    formData.append('name', name);
    formData.append('comment', comment);

    BX.proxy(_th.validate(), _th);

    BX.ajax.runComponentAction('spiks:reviews', 'addReviews', {
      mode: 'class',
      data: formData,
    }).then(function (data) {
      if (data.data.status == true) {
        window.app.components.modalReviews.show();
        element.querySelector('[type=submit]').disabled = true;
        setTimeout(() => {
          window.app.components.modalReviews.hide();
          element.reset();
          stars.forEach((item) => {
            item.classList.remove('is-active');
          });
          inputActive.forEach((item) => {
            item.classList.remove('is-error');
          });
          element.querySelector('[type=submit]').disabled = false;
        }, 3000);
      } else {
        if(data.data.error.ID){
          document.querySelector('#modal--error-reviews .modal__body p .s1').innerHTML = data.data.error.ID;
        }
        if(data.data.error.NAME){
          document.querySelector('#modal--error-reviews .modal__body p .s2').innerHTML = data.data.error.NAME;
        }
        if(data.data.error.COMMENT){
          document.querySelector('#modal--error-reviews .modal__body p .s3').innerHTML = data.data.error.COMMENT;
        }
        window.app.components['modalError-reviews'].show();
        setTimeout(() => {
          window.app.components['modalError-reviews'].hide();
        }, 3000);
      }
    });
  },
}