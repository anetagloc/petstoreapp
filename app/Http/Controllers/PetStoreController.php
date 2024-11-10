<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetStoreService;

class PetStoreController extends Controller
{

    protected $petService; 
    public function __construct(PetStoreService $petService) 
    { 
        $this->petService = $petService; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //vadation fields
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ]);
    
        //download data and run service  method addPet
        try {
            $data = $request->all();
            $response = $this->petService->addPet($data);
            $newPetId = $response->json()['id'];
            
            //redirect and error handling
            return redirect()->route('dashboard')->with('success', 'Pet created successfully! New Pet ID: ' . $newPetId);
        } catch (\Exception $e) {
            return redirect()->route('pets.create')->withErrors('Error creating pet: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        try {
        //    download id from request
            $id = $request->query('petId');
            
            if (!$id) {
                return redirect()->back()->withErrors(['petId' => 'ID jest wymagane']);
            }
            // run method from service
            $pet = $this->petService->getPet((int) $id);
    
            // Not found pet in database
            if (empty($pet)) {
                return redirect()->route('dashboard')->withErrors('Pet not found.');
            }
    
            // Return view with data about pet
            return view('pets.show', compact('pet'));
            
        } catch (\Exception $e) {
            // log error and redirect
            return redirect()->route('dashboard')->withErrors('Error fetching pet: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try { 
            //run service method getPet and return view
            $pet = $this->petService->getPet($id); 
            return view('pets.edit', compact('pet')); 
            //redirect and error handling
        } catch (\Exception $e) { 
            return redirect()->route('dashboard')->withErrors('Error fetching pet: ' . $e->getMessage()); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //vadation fields
        $request->validate([ 
            'name' => 'required|string|max:255', 
            'status' => 'required|string|max:255' ]); 
        try { 
            //run method updatePet for service and redirect to page dashboard
            $response = $this->petService->updatePet($request->all(), $id); 
            return redirect()->route('dashboard')->with('success', 'Pet updated successfully!'); 
            // add error handling and if error redirect to view edit with error info
        } catch (Exception $e) { 
        return redirect()->route('pets.edit', ['pet' => $id])->withErrors('Error updating pet: ' . $e->getMessage()); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try { 
            //run method deletePet for service and redirect to page dashboard
            $response = $this->petService->deletePet($id); 
            return redirect()->route('dashboard')->with('success', 'Pet deleted successfully!'); 
            // add error handling and if error redirect to page dashboard with error info
        } catch (\Exception $e) { 
            return redirect()->route('dashboard')->withErrors('Error deleting pet: ' . $e->getMessage()); 
        }
    }
}
