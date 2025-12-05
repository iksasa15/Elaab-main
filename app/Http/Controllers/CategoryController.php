<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * عرض قائمة جميع التصنيفات
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * عرض تصنيف محدد مع ألعابه
     *
     * @param  Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // نقوم بتحميل العلاقة مع الألعاب مباشرة
        $category->load('games');

        return view('categories.show', compact('category'));
    }

    /**
     * عرض نموذج إنشاء تصنيف جديد
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * حفظ تصنيف جديد في قاعدة البيانات
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // معالجة الصورة إذا تم رفعها
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            $validated['image'] = $imagePath;
        }

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'تم إنشاء التصنيف بنجاح');
    }

    /**
     * عرض نموذج تعديل تصنيف
     *
     * @param  Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * تحديث تصنيف محدد في قاعدة البيانات
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // معالجة الصورة إذا تم رفعها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا وجدت
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('image')->store('category_images', 'public');
            $validated['image'] = $imagePath;
        }

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح');
    }

    /**
     * حذف تصنيف محدد من قاعدة البيانات
     *
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // تحقق مما إذا كان هناك ألعاب مرتبطة بهذا التصنيف
        if ($category->games()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'لا يمكن حذف هذا التصنيف لأنه يحتوي على ألعاب مرتبطة به');
        }

        // حذف الصورة إذا وجدت
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'تم حذف التصنيف بنجاح');
    }
}