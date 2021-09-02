document.getElementById('user_img').onchange = evt => {
  const [file] = document.getElementById('user_img').files
  if (file) {
    document.getElementById('img_preview').src = URL.createObjectURL(file)
  }
}