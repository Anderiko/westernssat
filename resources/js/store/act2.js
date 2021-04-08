export let act2 = [
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/saloon.jpeg',
            title: {
                dark: true,
                text: 'Saloon'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Le Saloon ! L’endroit préféré des cowboys ! Des bières, des jeux de cartes, de la musique et surtout un homme, il connaît toute la ville et toute la ville le connaît , le barman : Floyd Esperado !'
                },
                {
                    type: 'info',
                    text: 'En entrant dans le Saloon vous apercevez Pop’s et Sir Hammerlock… Comme par hasard. Mais il y a surtout Black Jack et Zaccash Whitmore les deux croupiers du Saloon, officiellement ils s’occupent des jeux du Saloon mais entre nous ils passent la plupart de leur temps à jouer avec les autres.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Zaccash Withmore',
                            picture: 'images/game/characters/Thomas.png'
                        },
                        text: 'Et c’est encore un full mon cher Black Jack ! Peut être auras-tu plus de chance la prochaine fois !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Black Jack',
                            picture: 'images/game/characters/nolan.png'
                        },
                        text: 'Hehe mon ami ! Si j’étais toi je ne parlerais pas aussi vite c’est une quinte de mon côté ! Envoie le beurre, l’argent du beurre et… le reste je m’en fiche en fait ! Floyd sers moi un whisky c’est Zaccash qui offre ! '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Floyd Esperado',
                            picture: 'images/game/characters/loic.png'
                        },
                        text: 'Tout de suite Black ! Laisse moi juste m’occuper de ce client qui vient d’arriver ! Que puis-je faire pour toi cowboy ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Floyd Esperado',
                            picture: 'images/game/characters/loic.png'
                        },
                        text: 'Evidemment que je connais tout le monde dans Lannion Town que ce soit Unlucky Luke, Doc ou… Je ferais mieux de ne pas prononcer son nom cela porte malheur depuis que Unlucky Luke s’est frotté à son bras droit Clint Westwood. Enfin je risque rien, après tout c’est un habitué… '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Zaccash Withmore',
                            picture: 'images/game/characters/Thomas.png'
                        },
                        text: 'Allons Allons lui dis pas tout ! J’en ai marre de mettre la misère à Black Jack'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Black Jack',
                            picture: 'images/game/characters/nolan.png'
                        },
                        text: 'Eeeeh ! Je viens de te battre…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Zaccash Withmore',
                            picture: 'images/game/characters/Thomas.png'
                        },
                        text: 'On va remédier à ça plus tard ! En attendant nous te proposons un jeu, l’ambiance est assez triste en ce moment avec cette affaire… On dévoile des infos que si tu réussis faut bien qu’on s’amuse !'
                    }
                },
                {
                    type: 'info',
                    text: 'Black Jack et Zaccash Whitmore accompagné de Floyd Esperado vous lance un défi contre une information restez calme et posé ce jeu pourrait bien vous vider…'
                },
            ]
        },
    },
    {
        type: 'scene',
        content: {
            bg: null,
            title: {
                dark: true,
                text: 'Saloon'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'guess',
                    content: {
                        text: 'Il faut que les cruches de 12L et 8L contiennent chacune 6L.',
                        name: 'saloon'
                    }
                },
            ]
        },
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/saloon.jpeg',
            title: {
                dark: true,
                text: 'Saloon'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Black Jack',
                            picture: 'images/game/characters/nolan.png'
                        },
                        text: 'Mais c’est qu’il t’a éclaté le rookie mon cher Zaccash !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Zaccash Withmore',
                            picture: 'images/game/characters/Thomas.png'
                        },
                        text: 'NOUS ! Black, il nous a éclaté ! On est censés être ensemble sur ce coup là ! Bon aller au moins on s’est amusé, donne lui ce qu’il attend Floyd… et toi le rookie repasse jouer avec nous une prochaine fois !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Floyd Esperado',
                            picture: 'images/game/characters/loic.png'
                        },
                        text: 'De sacrés loustiques ces deux là ! L’homme que tu cherches s’appelle Woody, il est un beau-parleur, un charlatan, ça m’étonnerait pas qu’il soit mêlé au braquage plus que ce qu’on ne le pense.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Floyd Esperado',
                            picture: 'images/game/characters/loic.png'
                        },
                        text: 'J’ai entendu dire qu’il fréquentait un autre saloon, un endroit malfamé qui ouvre le soir, comme tu le sais c’est pas très légal en ce moment avec les dernières mesures prises par Myra Starr… 135g de beurre non mais puis quoi encore j’ai un commerce à faire tourner moi… Bref bien entendu ces informations ne viennent pas de moi, aller file !'
                    }
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès au Repaire !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', 'images/game/maps/saloon.png', 'images/game/maps/repaire.png']
                    }
                },
            ]
        },
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/ruelle_etroite.jpeg',
            title: {
                dark: true,
                text: 'Entrée du repaire'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'La nuit est tombée sur Lannion Town, vous arrivez le lieu indiqué par le barman du Saloon. Deux hommes s’approchent de la grande porte l’un après l’autre et les yeux du garde apparaissent par la visière.'
                },
            ]
        },
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/ruelle_etroite.jpeg',
            title: {
                dark: false,
                text: 'Entrée du repaire'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Garde',
                            picture: 'images/game/characters/Garde.png'
                        },
                        text: 'Trois ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Homme',
                            picture: 'images/game/characters/Homme.png'
                        },
                        text: 'Cinq'
                    }
                },
                {
                    type: 'info',
                    text: 'La porte s\'ouvre et se refèrme derrière le premier homme.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Garde',
                            picture: 'images/game/characters/Garde.png'
                        },
                        text: 'Six ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Homme',
                            picture: 'images/game/characters/Homme2.png'
                        },
                        text: 'Trois'
                    }
                },
                {
                    type: 'info',
                    text: 'Le deuxième homme disparaît lui aussi à l\'intérieur... Vous vous approchez.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Garde',
                            picture: 'images/game/characters/Garde.png'
                        },
                        text: 'Sept ?'
                    }
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Le garde vous demande sept, que devez vous lui répondre ?',
                        name: 'passcode'
                    }
                }
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/saloon.jpeg',
            title: {
                dark: false,
                text: 'Repaire'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Bien joué vous avez réussi à entrer ! Voici le repaire, un saloon malfamé où les pires crapules viennent jouer, boire et s’amuser en toute illégalité. La liste des personnes présentes est assez longue mais attention, Woody vient à votre rencontre.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Woody',
                            picture: 'images/game/characters/tristanb.png'
                        },
                        text: 'Ah ! je me doutais que tu ne tarderais pas à venir me voir, les nouvelles vont vite tu as retrouvé mon petit Jesse James ? Je me doutais qu’il dévoilerait des informations c’est un coyotte solitaire… Malheureusement je crois que tu ne pourras pas aller plus loin. Je n’ai pas de nouvelles de Jack et Annie ne montre jamais son visage, même à moi.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Woody',
                            picture: 'images/game/characters/tristanb.png'
                        },
                        text: 'Tu ne peux rien contre moi, je t’en prie reste et profite des danseuses et des jeux ! Clint ! Surveille ce jeune homme pour moi, il est mon invité ! Et arrête de ressasser ta défaite !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Clint Westwood',
                            picture: 'images/game/characters/TristanH.png'
                        },
                        text: 'Je l’aurai un jour… je l’aurai…'
                    }
                },
                {
                    type: 'info',
                    text: 'Votre regard se porte tout autour de vous, tout le monde semble s’amuser, les danseuses à côté du pianiste parlent de vous…'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Calamity Jane',
                            picture: 'images/game/characters/lucile.png'
                        },
                        text: 'Pssst ! Dusty… pssst ! t’as vu là bas c’est le larbin du Marshall !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Dusty Rose',
                            picture: 'images/game/characters/Axelle.png'
                        },
                        text: 'Comment a-t-il fait pour entrer ?!'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'Taisez-vous, on continue, faut surtout pas énerver Woody !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Calamity Jane',
                            picture: 'images/game/characters/lucile.png'
                        },
                        text: 'Il vient vers nous…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Dusty Rose',
                            picture: 'images/game/characters/Axelle.png'
                        },
                        text: 'Qu’est ce que tu nous veux ?!'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'De toute façon on est au courant de rien, aller voir Woody les filles laissez moi avec notre nouvel arrivant.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'Bon, je sais que je ne devrais pas être ici… Je joue habituellement au Saloon de Floyd mais voilà avec cette restriction de 18h je fais comment pour travailler moi ?! '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'Je suis un gars honnête crois moi et j’ai peut être une info qui te serait utile… Cependant j’aurais besoin de ton aide en échange j’ai quelques partitions qui se sont mélangées et je dois continuer à jouer je n’ai pas le temps de les trier.'
                    }
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Certaines paroles du pianiste n’ont pas été traduites dans leur version originale retrouvez le NOM de la chanson en anglais pour qu’il puisse continuer à jouer',
                        name: 'wannabe'
                    }
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Certaines paroles du pianiste n’ont pas été traduites dans leur version originale retrouvez le NOM de la chanson en anglais pour qu’il puisse continuer à jouer',
                        name: 'smooth'
                    }
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Certaines paroles du pianiste n’ont pas été traduites dans leur version originale retrouvez le NOM de la chanson en anglais pour qu’il puisse continuer à jouer',
                        name: 'everytime'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'Merci beaucoup, tu me sauves ! Les consignes sont strictes ici je veux pas de problèmes et encore moins avec un des gars ici-présent.'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'J’ai peut être une info qui pourrait t’intéresser, cela fait quelques soirs maintenant que je viens jouer ici et c’est vrai que les visages que je croise sont toujours les mêmes…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Scott Joplin',
                            picture: 'images/game/characters/robin.png'
                        },
                        text: 'En revanche, ce soir, peu avant que tu arrives, une danseuse était là mais je ne l’avais jamais vu pourtant la forme de son visage me disait quelque chose elle est partie dans sa loge quand tu es arrivé.'
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/loge.jpeg',
            title: {
                dark: false,
                text: 'Loge de la danseuse'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous arrivez dans une loge de danseuse, très atypique : des costumes, des robes, des foulards… Il y a beaucoup de déguisement d’ailleurs pour une danseuse… '
                },
                {
                    type: 'info',
                    text: 'Vous commencez à avancer dans la pièce et une présence se fait sentir derrière vous… cette fois c’est sûr c’est Annie Oakley !'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Annie Oakley',
                            picture: 'images/game/characters/Morgane.png'
                        },
                        text: 'Si tu te retournes j’te descends, si tu essaies de me regarder j’te descends… Très peu sont ceux qui sont encore en vie après avoir vu mon visage. '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Annie Oakley',
                            picture: 'images/game/characters/Morgane.png'
                        },
                        text: 'Tu m’as retrouvé, je te félicite, je te propose un marché : tu me laisses partir sans me voir contre mon aide pour retrouver les lingots ?'
                    }
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Répondez à l\'énigme d\'Annie Oakley pour continuer',
                        name: 'cards'
                    }
                },
                {
                    type: 'info',
                    text: 'Aucune réponse n’est donnée par Oakley… Est-elle encore là ? Vous vous retournez et trouvez la pièce vide… son information… '
                },
                {
                    type: 'info',
                    text: 'Vous découvrez un paquet de cartes caché dans la loge'
                },
                {
                    type: 'info',
                    text: 'Vous possédez désormais 2 morceaux du parchemin menant à la cachette du trésor, il n’en manque qu’un seul celui de Jack Daniels. '
                },
                {
                    type: 'info',
                    text: 'Alors que vous étiez en train de rechercher les deux premiers morceaux, le Shérif Walker de la contrée Farm Trégor et notre shérif la célèbre Myra Starr se sont activés sur un indice reçu par un informateur inconnu…'
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès au Bureau des shériffs !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', 'images/game/maps/saloon.png', 'images/game/maps/repaire.png', 'images/game/maps/sheriff.png', ]
                    }
                },
            ]
        }
    },
]
