<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.creer', compact('categories'));
    }

    public function enregistrer(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorieId' => 'required|exists:categories,id',
            'etat' => 'required|in:disponible,ruptureStock,enStock',
        ]);

        Produit::create($data);

        return redirect()->route('produits.index');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'categorieId' => 'required|exists:categories,id',
        'etat' => 'required|in:disponible,ruptureStock,enStock',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
    ]);

    // Upload de l'image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('produit_images');
        $data['image'] = $imagePath;
    }

    Produit::create($data);

    return redirect()->route('produits.index');
}
    public function afficher(Produit $produit)
    {
        return view('produits.afficher', compact('produit'));
    }

    public function modifier(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.modifier', compact('produit', 'categories'));
    }

    public function mettreAJour(Request $request, Produit $produit)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'categorieId' => 'required|exists:categories,id',
        'etat' => 'required|in:disponible,ruptureStock,enStock',
    ]);

    $produit->update($data);

    return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès');
}

    public function supprimer(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index');
    }
}
