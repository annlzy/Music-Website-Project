function hearttoggle(x) {8
    x.classList.toggle("heart-fill");
  } 

  
  let items = document.querySelectorAll('.carousel-mid .carousel-item2')

  items.forEach((el) => {
    const minPerSlide = 6
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
      if (!next) {
          // wrap carousel by using first child
          next = items[0]
      }
      let cloneChild = next.cloneNode(true)
      el.appendChild(cloneChild.children[0])
      next = next.nextElementSibling
  }
})

let upevt = document.querySelectorAll('.carousel-upevt .carousel-item3')

  upevt.forEach((el) => {
    const minPerSlide = 2;
    let next = el.nextElementSibling;
    for (var i=1; i<minPerSlide; i++) {
      if (!next) {
          // wrap carousel by using first child
          next = upevt[0]
      }
      let cloneChild = next.cloneNode(true);
      el.appendChild(cloneChild.children[0]);
      next = next.nextElementSibling;
  }
})


