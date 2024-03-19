<?php
namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
      $sections = Section::all();
      return view('Dashboard.Sections.index',compact('sections'));
    }

    public function store($request)
     {
    //     $validated = $request->validate([
    //         'name' => 'required|unique:section_translations|min:4|max:255',

    //     ]);
        Section::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('add');
        return redirect()->route('Sections.index');
    }

    public function update($request)
    {
        $section = Section::findOrFail($request->id);
        $section->update([
            'name' => $request->input('name'),
        ]);
        session()->flash('edit');
        return redirect()->route('Sections.index');
    }


    public function destroy($request)
    {
        Section::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Sections.index');
    }

}
