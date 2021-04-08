export let act3 = [
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/saloon.jpeg',
            title: {
                dark: false,
                text: 'Bureau des shériffs'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous arrivez au bureau des shériffs. Les gardiens de la paix dans la ville s’y sont succédés et c’est désormais une femme, Myra Starr, qui l’occupe.'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Myra Starr',
                            picture: 'images/game/characters/celia.png'
                        },
                        text: 'Walker t’as essayé dans cet ordre là ?'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Walker',
                            picture: 'images/game/characters/mouad.png'
                        },
                        text: 'Oui j’ai essayé mais ça ne marche pas non plus ! Je n’ai plus le temps Myra je dois partir, j’ai une ville à protéger, les nouvelles vont vite et Trégor Farm a besoin de moi pour les rassurer… j’ai tout essayé je ne peux plus rien pour toi'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Myra Starr',
                            picture: 'images/game/characters/celia.png'
                        },
                        text: 'Tu vas vraiment me laisser là ?! Mais enfin on est si proche du but ! Que vont dire les gens si je ne suis pas capable de les protéger ? Je ne peux pas les décevoir !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Walker',
                            picture: 'images/game/characters/mouad.png'
                        },
                        text: 'J’ai fait au mieux Myra mais j’ai atteint mes limites, à plus…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Myra Starr',
                            picture: 'images/game/characters/celia.png'
                        },
                        text: 'Bon… je comprends… je te souhaite bon courage dans ta ville la tension est sûrement en train de monter là bas aussi.'
                    }
                },
                {
                    type: 'info',
                    text: 'Walker sort et vous salue en partant'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Myra Starr',
                            picture: 'images/game/characters/celia.png'
                        },
                        text: 'Tiens c’est toi ! Il fallait que je te remercie pour le travail que tu as fait, nous sommes si proches du but grâce à toi. Nous avons reçu un indice d’un informateur mais malheureusement, avec Walker, il nous a été impossible de le décrypter. '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Myra Starr',
                            picture: 'images/game/characters/celia.png'
                        },
                        text: 'C’est un seul mot posé là, on soupçonne Kate Harris de nous aider. Il semblerait qu’elle n’ait pas appréciée que quelqu’un lui fasse de l’ombre. Je ne sais plus quoi faire…'
                    }
                },
                {
                    type: 'info',
                    text: 'Vous vous approchez du bureau pour regarder l’avancée des deux shérifs peut être pourrez vous découvrir un indice qu’ils n’ont pas encore vu…'
                },
                {
                    type: 'guess',
                    content: {
                        text: 'Déchiffrez le code de l\'informateur mystère, pour comprendre comment le code fonctionne cliquez sur le bouton notice',
                        name: 'cesar'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Myra Starr',
                            picture: 'images/game/characters/celia.png'
                        },
                        text: 'Tes talents semblent être à la hauteur de ta réputation… Merci pour ton aide ! J’ai encore deux ou trois trucs à faire au niveau de la paperasse je te laisse continuer, le message est désormais assez clair. Bon courage !'
                    }
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès au Ranch !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', 'images/game/maps/saloon.png', 'images/game/maps/repaire.png', 'images/game/maps/sheriff.png', 'images/game/maps/ranch.png', ]
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/ranch.png',
            title: {
                dark: false,
                text: 'Ranch Mountainview'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Vous arrivez au ranch, tous les chevaux y sont entreposés. Vous apercevez Unlucky Luke sur son cheval quelle chance de pouvoir parler à celui qui a commencé l’enquête. Mais il n’a jamais pu achever ce qu’il avait commencé…'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Unlucky Luke',
                            picture: 'images/game/characters/hugo.png'
                        },
                        text: 'Voilà le nouveau qui s’est remis sur l’enquête ! Tout ça parce que j’ai jamais pu obtenir une preuve contre Woody… Te fais pas d’illusions gamin il est intouchable et son trésor est trop bien caché…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Unlucky Luke',
                            picture: 'images/game/characters/hugo.png'
                        },
                        text: 'Comment ? Tu as déjà deux tiers du parchemin ? Cela signifie qu’il ne te manque que la partie de Jack Daniels ? L’espoir est peut être en train de renaître finalement ! Je dois terminer de ramener les chevaux dans leur enclos mais on peut peut être en discuter juste après.'
                    }
                },
                {
                    type: 'info',
                    text: 'Aidez Unlucky Luke dans son travail pour aller plus vite, ne vous précipitez pas pour éviter la ruade.'
                },
                {
                    type: 'guess',
                    content: {
                        text: 'L\'objectif est d\'intervertir le placement des cavaliers noirs et les blancs en utilisant des coups comme aux échecs.',
                        name: 'knights'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Unlucky Luke',
                            picture: 'images/game/characters/hugo.png'
                        },
                        text: 'Merci pour ton aide ! Maintenant on peut discuter. Mon enquête m’avait mené jusque chez les indiens, dans les vastes plaines du Phare Ouest. Ils avaient été soudoyés par les bandits j’en suis sûr, j’avais repéré des emballages de beurre salé dans certains buissons. '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Unlucky Luke',
                            picture: 'images/game/characters/hugo.png'
                        },
                        text: 'Cependant, ils n’ont jamais voulu me donner une quelconque information. Ils sont comme ça, ils veulent quelque chose en échange, méfie-toi ils sont sévères en affaires…'
                    }
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès aux Plaines !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', 'images/game/maps/saloon.png', 'images/game/maps/repaire.png', 'images/game/maps/sheriff.png', 'images/game/maps/ranch.png', 'images/game/maps/plaines.png', ]
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/plaine.png',
            title: {
                dark: false,
                text: 'Plaines Paisibles'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'info',
                    text: 'Les plaines, vastes étendues où vivent encore les amérindiens, ils profitent de ce que leur propose la nature… Vous les apercevez au loin, ils jouent… au caps… Il faut d’ailleurs préciser que la distance n’est pas très réglementaire…'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Et hop ! Tu prends ton cul sec !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Ashteh Teipeh',
                            picture: 'images/game/characters/yoann.png'
                        },
                        text: 'N’importe quoi ! J’en ai une à défendre !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Ashteh Teipeh',
                            picture: 'images/game/characters/yoann.png'
                        },
                        text: 'Bon bah là j’ai perdu… t’es trop près aussi c’est pour ça ! Je veux ma revanche !'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Attends, regarde qui vient là, un gars de la ville…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Ashteh Teipeh',
                            picture: 'images/game/characters/yoann.png'
                        },
                        text: 'Il nous veut quoi à ton avis ? '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Il est sûrement à la recherche de tu-sais-qui…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Ashteh Teipeh',
                            picture: 'images/game/characters/yoann.png'
                        },
                        text: 'Kate Harris ?!'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Mais non abruti ! Tais toi le vlà, fais le sketch habituel'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Pourquoi toi venir voir nous ? '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Ashteh Teipeh',
                            picture: 'images/game/characters/yoann.png'
                        },
                        text: 'Nous pas avoir informations toi rechercher. A moins que toi aider nous…'
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Nous devoir envoyer signaux fumée mais avoir du mal a coordonner'
                    }
                },
                {
                    type: 'info',
                    text: 'Les indiens demandent de l\'aide pour recoordonner les signaux de fumée, prenez votre temps attention à ne pas vous enflammer.'
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: null,
            title: {
                dark: false,
                text: 'Plaines Paisibles'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'guess',
                    content: {
                        text: 'L\'objectif est d\'obtenir que des tipis en cliquant sur les icones pour les changer.',
                        name: 'signals'
                    }
                },
            ]
        }
    },
    {
        type: 'scene',
        content: {
            bg: 'images/game/bg/plaine.png',
            title: {
                dark: false,
                text: 'Plaines Paisibles'
            },
            currentAction: 0,
            actions: [
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Akecheta',
                            picture: 'images/game/characters/erwan.png'
                        },
                        text: 'Wouah ! Personne avait jamais réussi… Merde mon rôle ! Bon tant pis, tu as réussi nous allons honorer notre part du marché, suis moi !'
                    }
                },
                {
                    type: 'info',
                    text: 'Vous entrez dans une sorte de grotte et y découvrez… Jack Daniel !'
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Jack Daniel',
                            picture: 'images/game/characters/mathieu.png'
                        },
                        text: 'Mon ami ! je t’attendais ! je suis Jack Daniel le bandit mais aussi et surtout le nouveau membre de la tribu des amérindiens vivant aux abords de Lannion Town. '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Jack Daniel',
                            picture: 'images/game/characters/mathieu.png'
                        },
                        text: 'Pourquoi je suis ici ? Eh bien ! Vois tu cher ami, je suis désormais en adéquation avec la nature, j’ai adopté leur style de vie pour me sentir pleinement moi-même, je n’ai que faire des richesses ou de la gloire à présent, seule ma paix intérieure m’intéresse… et le caps ! '
                    }
                },
                {
                    type: 'dialog',
                    content: {
                        character: {
                            name: 'Jack Daniel',
                            picture: 'images/game/characters/mathieu.png'
                        },
                        text: 'Pour te prouver mon changement laisse moi t’offrir mon morceau de parchemin. Je te souhaite bon courage dans ta quête du trésor.'
                    }
                },

                {
                    type: 'info',
                    text: 'Vous disposez désormais de la carte au complet, il est grand temps de mettre un terme à cette affaire.'
                },
                {
                    type: 'map',
                    content: {
                        text: 'Vous avez désormais accès au Phare !',
                        file: ['images/game/maps/banque.png', 'images/game/maps/imprimerie.png', 'images/game/maps/ruelle.png', 'images/game/maps/saloon.png', 'images/game/maps/repaire.png', 'images/game/maps/sheriff.png', 'images/game/maps/ranch.png', 'images/game/maps/plaines.png', 'images/game/maps/phare.png']
                    }
                },
            ]
        }
    },
]
