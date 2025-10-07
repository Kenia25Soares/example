import './bootstrap';

// document.addEventListener('DOMContentLoaded', function () {
    
//     // 1. Encontrar o link "Home"
//     const homeLink = document.querySelector('nav a[href="/"]');

//     // Encontrar e declarar o container do conteúdo (div)
//     const homeContentContainer = document.getElementById('home-content-container'); 

//     // O código só corre se ambos os elementos existirem (só na página Home)
//     if (homeLink && homeContentContainer) {
        
//         // Define o estado inicial. Se estiver vazio (''), torna visível ('block').
//         // Isto é para o primeiro clique funcionar corretamente.
//         if (homeContentContainer.style.display === '') {
//             homeContentContainer.style.display = 'block';
//         }
        
//         homeLink.addEventListener('click', function(event) {
//             event.preventDefault(); 
            
//             // Alterna a visibilidade
//             if (homeContentContainer.style.display === 'none') {
//                 homeContentContainer.style.display = 'block';
//             } else {
//                 homeContentContainer.style.display = 'none';
//             }
//         });
//     }
// });