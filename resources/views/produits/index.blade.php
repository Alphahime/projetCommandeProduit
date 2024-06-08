<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        
        <div class="bg-gray-800 text-white w-64 flex flex-col">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-2xl font-bold">Tableau de bord</h1>
            </div>
            <div class="flex-grow mt-4">
                <ul>
                    <li><a href="{{ route('produits.index') }}" class="block py-2 px-4 text-sm flex items-center"><i class="fas fa-list mr-2"></i>Liste des Produits</a></li>
                    <li><a href="{{ route('produits.creer') }}" class="block py-2 px-4 text-sm flex items-center"><i class="fas fa-plus mr-2"></i>Ajouter un Produit</a></li>
                    <li><a href="#" class="block py-2 px-4 text-sm flex items-center"><i class="fas fa-list-alt mr-2"></i>Liste des commandes</a></li>
                    <li><a href="#" class="block py-2 px-4 text-sm flex items-center"><i class="fas fa-shopping-cart mr-2"></i>Commande disponible</a></li>
                    <li><a href="#" class="block py-2 px-4 text-sm flex items-center"><i class="fas fa-exclamation-triangle mr-2"></i>Produit en rupture</a></li>
                    <li><a href="#" class="block py-2 px-4 text-sm flex items-center"><i class="fas fa-box-open mr-2"></i>Produit en stock</a></li>
                </ul>
            </div>
            
        </div>
        
        <div class="flex-grow p-8">
            <h1 class="text-2xl font-bold mb-4">Liste des Produits</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($produits as $produit)
                    <div class="bg-white rounded-lg shadow-lg">
                        <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit" class="h-64 w-full object-cover rounded-t-lg">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold">{{ $produit->nom }}</h2>
                            <p class="text-gray-600">{{ $produit->prix }}</p>
                            <p class="text-gray-600">{{ optional($produit->categorie)->nom }}</p>
                            <p class="text-gray-600">{{ $produit->etat }}</p>
                            <a href="{{ route('produits.afficher', $produit->id) }}" class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye mr-1"></i>Voir</a>
                            <a href="{{ route('produits.modifier', $produit->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2"><i class="fas fa-edit mr-1"></i>Modifier</a>
                            <form action="{{ route('produits.supprimer', $produit->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt mr-1"></i>Supprimer</button>
                            </form>
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
