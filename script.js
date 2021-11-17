function showPassword() {
    var x = document.getElementById("mypassword");
    if (x.type === "password") {
        x.type = "text";
    }  else{
        x.type = "password"
    }
}

let changeIcon = function(icon) {
    icon.classList.toggle('uil-eye-slash')
}


let changeIcon2 = (icon) => {
    icon.classList.toggle('uil-times');
}

const mql = require('@microlink/mql')

const fullScreenshot = async (url, opts) => {
  const { data } = await mql(url, {
    meta: false,
    screenshot: true,
    fullPage: true,
    ...opts,
  })

  return data.screenshot
}

