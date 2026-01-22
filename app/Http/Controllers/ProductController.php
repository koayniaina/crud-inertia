<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    // 1️⃣ Affiche la liste des produits
    public function index()
    {
        $products = Product::get();
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    // 2️⃣ Affiche le formulaire de création
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    // 3️⃣ Enregistre un nouveau produit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès !');
    }

    // 4️⃣ Affiche un produit spécifique (facultatif pour CRUD Vue)
    // public function show(Product $product)
    // {
    //     return Inertia::render('Products/Show', [
    //         'product' => $product
    //     ]);
    // }

    // 5️⃣ Affiche le formulaire d’édition
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    // 6️⃣ Met à jour un produit existant
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès !');
    }

    // 7️⃣ Supprime un produit
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès !');
    }
}
