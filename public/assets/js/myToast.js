function myToast(t, m){
  const toast = $('.toast');
  const toastSide = $('.toast-side');
  const toastTitle = $('.toast-title');
  const toastSubtitle = $('.toast-subtitle');
  const toastIcon = $('.toast-icon');
  const toastCloseButton = $('.btn-close');
  const toastProgressBar = $('.progress-bar');
  const toastData = {
    type: t,
    message: m
  };

  if (toast.length) {
    if (toastData) {
      const toastAtrribute = toastData.type;
      const message = toastData.message;
      
      let title, icon, color;
      switch (toastAtrribute) {
        case 'success':
          title = 'Success!';
          icon = 'fa-solid fa-check';
          color = 'success';
          break;
        case 'error':
          title = 'Something went wrong!';
          icon = 'fa-solid fa-x';
          color = 'danger';
          break;
        case 'warning':
          title = 'Warning!';
          icon = 'fa-solid fa-info';
          color = 'warning';
          break;
        case 'info':
          title = 'Information!';
          icon = 'fa-solid fa-info';
          color = 'info';
          break;
        case 'welcome':
          title = 'Hello!'
          icon = 'fa-regular fa-hand'
          color = 'primary';
      }

      toast.removeClass('border-success border-danger border-warning border-info border-primary');
      toastSide.removeClass('bg-success bg-danger bg-warning bg-info bg-primary');
      toastIcon.removeClass('fa-solid fa-check fa-solid fa-x fa-solid fa-info fa-regular fa-hand');

      toast.addClass('border-'+color);
      toastSide.addClass('bg-'+color);
      toastTitle.html(title);
      toastSubtitle.html(message);
      toastIcon.addClass(icon);
      toastProgressBar[0].style.setProperty('--progress-color', `var(--${color})`);
    }
    
    toast.addClass('active');
    toastProgressBar.addClass('active');

    setTimeout(function() {
      toast.removeClass('active');
    }, 4000);
    
    setTimeout(function() {
      toastProgressBar.removeClass('active');
    }, 4300);
  }

  if (toastCloseButton.length) {
    toastCloseButton.on('click', function() {
      toast.removeClass('active');
      
      setTimeout(function() {
        toastProgressBar.removeClass('active');
      }, 300);
    });
  } 
}