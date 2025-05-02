// this is a javascript function to add lazy loading to all images on the site
const images = document.querySelectorAll('img');
images.forEach(img => {
  img.setAttribute('loading', 'lazy');
});
