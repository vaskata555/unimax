const stripe = Stripe("pk_test_51MkU5NGKg9SGeuD8jtKXpJMKSzcmS7Ouzo4Oa4XEn2C9xQ2jt2P8umSxBjWaivnHxWuhr76nVOcewX6Ss6JWVZ9n00Nf6JV0dR")
const btn = document.querySelector('#btn')
btn.addEventListener('click', ()=>{
    fetch('checkout.php',{
        method:"POST",
        headers:{
            'Content-Type' : 'application/json',
        },
        body: JSON.stringify({})
    }).then(res=> res.json())
    .then(payload => {
        stripe.redirectToCheckout({sessionId: payload.id})
    })
})