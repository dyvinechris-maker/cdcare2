// Rotate chevron on expand/collapse
$(document).on('show.bs.collapse', '#faqCollapse1', function () {
  $('a[href="#faqCollapse1"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse1', function () {
  $('a[href="#faqCollapse1"]').find('.chevron').removeClass('rotated');
});

// Copy link
document.getElementById('copyLinkBtn').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse1';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Second FAQ: Rotate chevron
$(document).on('show.bs.collapse', '#faqCollapse2', function () {
  $('a[href="#faqCollapse2"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse2', function () {
  $('a[href="#faqCollapse2"]').find('.chevron').removeClass('rotated');
});

// Copy link for second FAQ
document.getElementById('copyLinkBtn2').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse2';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback2');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Third FAQ: Rotate chevron (down → up)
$(document).on('show.bs.collapse', '#faqCollapse3', function () {
  $('a[href="#faqCollapse3"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse3', function () {
  $('a[href="#faqCollapse3"]').find('.chevron').removeClass('rotated');
});

// Copy link for third FAQ
document.getElementById('copyLinkBtn3').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse3';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback3');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Fourth FAQ: Rotate chevron (right → down)
$(document).on('show.bs.collapse', '#faqCollapse4', function () {
  $('a[href="#faqCollapse4"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse4', function () {
  $('a[href="#faqCollapse4"]').find('.chevron').removeClass('rotated');
});

// Copy link for fourth FAQ
document.getElementById('copyLinkBtn4').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse4';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback4');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Fifth FAQ: Rotate chevron (down → up) with 180°
$(document).on('show.bs.collapse', '#faqCollapse5', function () {
  $('a[href="#faqCollapse5"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse5', function () {
  $('a[href="#faqCollapse5"]').find('.chevron').removeClass('rotated');
});

// Copy link for fifth FAQ
document.getElementById('copyLinkBtn5').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse5';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback5');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Sixth FAQ: Rotate chevron (down → up) with 180°
$(document).on('show.bs.collapse', '#faqCollapse6', function () {
  $('a[href="#faqCollapse6"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse6', function () {
  $('a[href="#faqCollapse6"]').find('.chevron').removeClass('rotated');
});

// Copy link for sixth FAQ
document.getElementById('copyLinkBtn6').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse6';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback6');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Eighth FAQ: Rotate chevron (down to up) with 180 degrees
$(document).on('show.bs.collapse', '#faqCollapse8', function () {
  $('a[href="#faqCollapse8"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse8', function () {
  $('a[href="#faqCollapse8"]').find('.chevron').removeClass('rotated');
});

// Copy link for eighth FAQ
document.getElementById('copyLinkBtn8').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse8';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback8');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Ninth FAQ: Rotate chevron (down to up) with 180 degrees
$(document).on('show.bs.collapse', '#faqCollapse9', function () {
  $('a[href="#faqCollapse9"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse9', function () {
  $('a[href="#faqCollapse9"]').find('.chevron').removeClass('rotated');
});

// Copy link for ninth FAQ
document.getElementById('copyLinkBtn9').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse9';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback9');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});

// Tenth FAQ: Rotate chevron (down to up) with 180 degrees
$(document).on('show.bs.collapse', '#faqCollapse10', function () {
  $('a[href="#faqCollapse10"]').find('.chevron').addClass('rotated');
});

$(document).on('hide.bs.collapse', '#faqCollapse10', function () {
  $('a[href="#faqCollapse10"]').find('.chevron').removeClass('rotated');
});

// Copy link for tenth FAQ
document.getElementById('copyLinkBtn10').addEventListener('click', function () {
  const url = window.location.href.split('#')[0] + '#faqCollapse10';
  navigator.clipboard.writeText(url).then(() => {
    const feedback = document.getElementById('copyFeedback10');
    feedback.classList.add('show');
    setTimeout(() => feedback.classList.remove('show'), 2000);
  }).catch(() => {
    alert('Failed to copy link');
  });
});