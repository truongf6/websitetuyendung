   <!-- SCRIPTS -->
   <script src="/temp/assets/js/jquery.min.js"></script>
   <script src="/temp/assets/js/bootstrap.bundle.min.js"></script>
   <script src="/temp/assets/js/isotope.pkgd.min.js"></script>
   <script src="/temp/assets/js/stickyfill.min.js"></script>
   <script src="/temp/assets/js/jquery.fancybox.min.js"></script>
   <script src="/temp/assets/js/jquery.easing.1.3.js"></script>
   <script src="/temp/assets/js/jquery.waypoints.min.js"></script>
   <script src="/temp/assets/js/jquery.animateNumber.min.js"></script>
   <script src="/temp/assets/js/owl.carousel.min.js"></script>
   <script src="/temp/assets/js/bootstrap-select.min.js"></script>
   <script src="/temp/assets/js/custom.js"></script>
   <script src="/temp/assets/js/quill.min.js"></script>
   <script>
      $('#form-pay__money').submit(function (e) {
         e.preventDefault(); // Ngăn chặn hành động mặc định

         const $amount_money = $('#input-amount__money').val();

         if (!$amount_money) {
            alert('Bạn chưa nhập số tiền.');
         } else {
            if (parseInt($amount_money) < 10000) {
                  alert('Số tiền không được nhỏ hơn 10.000đ.');
            } else {
                  // Sử dụng `unbind` để bỏ sự kiện submit trước khi gửi form
                  $(this).off('submit').submit();
            }
         }
      });

      $(' form button[type="submit"]').on('click', function(e){
         e.preventDefault();
         let form = $(this).closest('form');
         let formID = form.attr('id');
         // let formAction = form.data('action'); // Lấy route action từ thuộc tính data-action
         if(validateForm(`#${formID}`)) {
               form.submit();
         }
      });
   // Kiểm tra dữ liệu đầu vào đã nhập hay chưa ?
      function validateForm(formID) {
         let checkValid = true;
         $(formID).find('.input-field').each(function(){
            let value = $(this).val();
            let fieldType = $(this).attr('type'); // Get input field type
            $(this).removeClass('input-error'); // Remove input-error class
            $(this).parent().find('.helper').remove();  // Xóa thông báo lỗi cũ

            // Check if the field is an email input and validate the format
            // if (fieldType == 'email' && value !== '') {
            //       if (!isValidEmail(value)) {
            //          checkValid = false;
            //          $(this).addClass('input-error');
            //          let emailAlert = `<span class="helper text-danger" style="z-index: 999;margin-top: 75px;">Chưa nhập đúng kiểu email</span>`;
            //          $(this).parent().append(emailAlert);
            //       }
            // }
            if(value == null || value == '' || value == undefined) {
                  checkValid = false;
                  $(this).addClass('input-error');
                  let htmlAlert = `<span class="helper text-danger" style="z-index: 999;margin-top: 75px;">${$(this).data('require')}</span>`;
                  $(this).parent().append(htmlAlert);
            }
         });
         return checkValid;
      }
   </script>
   {{-- <script src="/temp/js/validate.js"></script> --}}
   