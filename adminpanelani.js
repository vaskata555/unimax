console.clear();
const panel1 = document.querySelector("#panel1");

const target = document.querySelector(".1stadminpanel");

panel1.addEventListener("click", () => (target.style.opacity = 0));
panel1.addEventListener("click", () => gsap.set(target, { opacity: 1 }));


