document.addEventListener('DOMContentLoaded', () => {
    const upBtn = document.querySelector('.up-btn');

    const onScroll = () => {
        upBtn.style.display = window.scrollY > 200 ? 'block' : 'none';
    };

    window.addEventListener('scroll', onScroll);
    onScroll();

    upBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const header = document.getElementById('header');

    window.addEventListener('scroll', () => {
        header.classList.toggle('sticky', window.scrollY > 0);
    });
});




var app = angular.module("home", []);


app.controller("home_controller", function ($scope) {

    $scope.images = ["xbox", "nintendo_switch", "sega", "bethesda", "rockstar", "acti_vision", "ubisoft", "EA", "microsoft", "sony", "pokemon", "bandai_namco", "tencent", "iron_galaxy", "take-two", "blizzard", "capcom"];

    $scope.faq_contents = [
        {
            query: "What payment methods do you accept?",
            answer: "We accept major credit cards, PayPal, and gift cards. All transactions are secure.",
            id: "1"
        },
        {
            query: "Can I buy digital and physical games together?",
            answer: "Yes, you can combine digital downloads and physical copies in the same order. Shipping applies only to physical items.",
            id: "2"
        },
        {
            query: "How long does shipping take?",
            answer: "Standard shipping takes 3-7 business days, depending on your location. Express shipping is available at checkout.",
            id: "3"
        },
        {
            query: "Do you offer pre-order bonuses?",
            answer: "Yes! Pre-order games often include exclusive in-game content or collectibles. Check the product page for details.",
            id: "4"
        },
        {
            query: "Can I gift a digital game to a friend?",
            answer: "Absolutely! During checkout, select “Send as a gift” and enter your friend’s email to deliver the game digitally.",
            id: "5"
        },
        {
            query: "How do I redeem a game code?",
            answer: "After purchase, you will receive a code via email. Enter it in your platform’s store (Steam, Epic Games, etc.) to redeem your game.",
            id: "6"
        },
        {
            query: "Do you provide refunds for digital games?",
            answer: "Refunds for digital games depend on the platform's policies. For most platforms, games must not be downloaded or played for refund eligibility.",
            id: "7"
        },
    ];

    $scope.testimonial_content = [
        {
            title:"\"Fragstore has completely changed how I discover and buy games — the selection is unmatched!\"",
            author:"– Alex V., Pro Gamer"
        },
        {
            title:"\"Fast delivery, awesome deals, and a community that really understands gamers. Fragstore is my go-to!\"",
            author:"– Maya L., Content Creator"
        },
        {
            title:"\"From indie gems to AAA hits, Fragstore always has exactly what I’m looking for. Shopping here is a joy.\"",
            author:"– Jordan K., Game Enthusiast"
        } 
    ];

    $scope.upcoming_games = [
        {
            img:"https://cdn.mos.cms.futurecdn.net/iPi3bFFgSfLnoNe8NS764n.jpg",
            name:"Grand Theft Auto VI",
            desc:"Get ready for an epic new adventure!",
        },
        {
            img:"https://cdn.mos.cms.futurecdn.net/w9zhsvt8F3TNbamjRBg5Be.jpg",
            name:"Fallout 5",
            desc:"RPG adventure with multiplayer mode.",
        },
                {
            img:"https://gaming-cdn.com/images/products/6369/orig/the-sims-5-pc-mac-ea-app-cover.jpg?v=1753367505",
            name:"Sims 5",
            desc:"High-octane action and story-driven gameplay.",
        },
        {
            img:"https://static0.gamerantimages.com/wordpress/wp-content/uploads/wm/2025/01/bioshock-4-2025-game-rant.jpg?w=1600&h=900&fit=crop",
            name:"Bioshock 4",
            desc:"Next-level graphics and immersive experience.",
        }
    ];

    $scope.top_games = [
        {
            img:"https://upload.wikimedia.org/wikipedia/en/d/d0/List_of_Playable_characters_in_Persona_5.jpg",
            name:"Persona 5",
            prize:"$59.99",
            desc:"Exciting adventure with stunning graphics."
        },
        {
            img:"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR47LjFayYHU_-Hc43iGrZkvbyFmG5YXrcrmA&s",
            name:"Grand Theft Auto 5",
            prize:"$49.99",
            desc:"Fast-paced action and immersive story."
        },
        {
            img:"https://store-images.s-microsoft.com/image/apps.58752.68182501197884443.ac728a87-7bc1-4a0d-8bc6-0712072da93c.0cf58754-9802-46f8-8557-8d3ff32a627a?q=90&w=480&h=270",
            name:"Red Dead Redemption 2",
            prize:"$39.99",
            desc:"Fun casual gameplay for everyone."
        },
        {
            img:"https://media.wired.com/photos/639bf35a24c352e627eccc43/3:2/w_2560%2Cc_limit/Ragnaro%25CC%2588k-culture-ar1qdh.jpg",
            name:"God of War: Ragnarok",
            prize:"$29.99",
            desc:"Fun casual gameplay for everyone."
        }
    ];

    $scope.raters = [
        {
            img:"https://i.pravatar.cc/100?img=1",
            testimony:"“Fragstore is my go-to for exclusive gaming gear. Fast delivery and top-notch quality every time.”",
            name:"Alex Johnson",
            job:"Pro Gamer",
        },
        {
            img:"https://i.pravatar.cc/100?img=2",
            testimony:"“I love the limited edition items. The site feels premium and the customer service is amazing.”",
            name:"Samantha Lee",
            job:"Streamer & Collector",
        },
        {
            img:"https://i.pravatar.cc/100?img=3",
            testimony:"“Excellent quality and smooth shopping experience. Definitely one of the best gaming stores out there.”",
            name:"Mark Rivera",
            job:"Esports Enthusiast",
        }
    ]
});


const filled = document.querySelector('.filled');

function updateProgressBar() {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;

    const scrollPercent = (scrollTop / docHeight) * 100;
    filled.style.width = `${scrollPercent}%`;
}

window.addEventListener("scroll", updateProgressBar);




