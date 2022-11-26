
let table = document.querySelector(".table");
let restBtn = document.querySelectorAll(".rest");

restBtn.forEach(function(b) {
    b.addEventListener("click", () => {
        table.innerHTML = "لايوجد بيانات لعرضها ابحث اولا";
    })
})


let btnsShowDetails = document.querySelectorAll(".show-details");
let allDetails = document.querySelectorAll(".details");

btnsShowDetails.forEach(function(btn) {
    btn.addEventListener("click", function() {

        this.classList.toggle("show");
        if (this.classList.contains("show")) {
            this.innerHTML = "اخفاء التفاصيل";
        } else {
            
            this.innerHTML = "اظهار التفاصيل";
        } 
        let className = btn.getAttribute("data-classname");
        document.querySelector(`.${className}`).classList.toggle("active");
    })
})