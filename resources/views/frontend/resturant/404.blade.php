
<!-- Include GSAP library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
<head>

    <title>{{ appName() }}</title>
    <link href="{{ favicon() }}" rel="icon">

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap");
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        overflow: hidden;
        background-color: #f4f6ff;
    }

    .container {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Poppins", sans-serif;
        position: relative;
        left: 6vmin;
        text-align: center;
    }

    .cog-wheel1,
    .cog-wheel2 {
        transform: scale(0.7);
    }

    .cog1,
    .cog2 {
        width: 40vmin;
        height: 40vmin;
        border-radius: 50%;
        border: 6vmin solid #f3c623;
        position: relative;
    }

    .cog2 {
        border: 6vmin solid #4f8a8b;
    }

    .top,
    .down,
    .left,
    .right,
    .left-top,
    .left-down,
    .right-top,
    .right-down {
        width: 10vmin;
        height: 10vmin;
        background-color: #f3c623;
        position: absolute;
    }

    .cog2 .top,
    .cog2 .down,
    .cog2 .left,
    .cog2 .right,
    .cog2 .left-top,
    .cog2 .left-down,
    .cog2 .right-top,
    .cog2 .right-down {
        background-color: #4f8a8b;
    }

    .top {
        top: -14vmin;
        left: 9vmin;
    }

    .down {
        bottom: -14vmin;
        left: 9vmin;
    }

    .left {
        left: -14vmin;
        top: 9vmin;
    }

    .right {
        right: -14vmin;
        top: 9vmin;
    }

    .left-top {
        transform: rotateZ(-45deg);
        left: -8vmin;
        top: -8vmin;
    }

    .left-down {
        transform: rotateZ(45deg);
        left: -8vmin;
        top: 25vmin;
    }

    .right-top {
        transform: rotateZ(45deg);
        right: -8vmin;
        top: -8vmin;
    }

    .right-down {
        transform: rotateZ(-45deg);
        right: -8vmin;
        top: 25vmin;
    }

    .cog2 {
        position: relative;
        left: -10.2vmin;
        bottom: 10vmin;
    }

    h1 {
        color: #142833;
    }

    .first-four {
        position: relative;
        left: 6vmin;
        font-size: 40vmin;
    }

    .second-four {
        position: relative;
        right: 18vmin;
        z-index: -1;
        font-size: 40vmin;
    }

    .wrong-para {
        font-family: "Montserrat", sans-serif;
        position: absolute;
        bottom: 15vmin;
        padding: 3vmin 12vmin 3vmin 3vmin;
        font-weight: 600;
        color: #092532;
    }

    .back-home-btn {
        margin-top: 20vmin;
        padding: 1.5vmin 3vmin;
        background-color: #4f8a8b;
        color: #fff;
        font-family: "Montserrat", sans-serif;
        font-size: 2vmin;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .back-home-btn:hover {
        background-color: #3c7070;
    }
</style>
</head>
<div class="col">
    <div class="container">
        <h1 class="first-four">4</h1>
        <div class="cog-wheel1">
            <div class="cog1">
                <div class="top"></div>
                <div class="down"></div>
                <div class="left-top"></div>
                <div class="left-down"></div>
                <div class="right-top"></div>
                <div class="right-down"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>

        <div class="cog-wheel2">
            <div class="cog2">
                <div class="top"></div>
                <div class="down"></div>
                <div class="left-top"></div>
                <div class="left-down"></div>
                <div class="right-top"></div>
                <div class="right-down"></div>
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>

        <h1 class="second-four">4</h1>
        <p class="wrong-para">Uh Oh! Page not found!</p>
    </div>

    <button class="back-home-btn" onclick="window.location.href='{{ url('/') }}'">Back to Home</button>
</div>
<script>
    let t1 = gsap.timeline();
    let t2 = gsap.timeline();
    let t3 = gsap.timeline();

    t1.to(".cog1", {
        transformOrigin: "50% 50%",
        rotation: "+=360",
        repeat: -1,
        ease: Linear.easeNone,
        duration: 8
    });

    t2.to(".cog2", {
        transformOrigin: "50% 50%",
        rotation: "-=360",
        repeat: -1,
        ease: Linear.easeNone,
        duration: 8
    });

    t3.fromTo(".wrong-para", {
        opacity: 0
    }, {
        opacity: 1,
        duration: 1,
        stagger: {
            repeat: -1,
            yoyo: true
        }
    });
</script>


{{-- the code demo view --}}
{{-- <!DOCTYPE html>
<html>

<head>
    <title>Interactive Code Snippet</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Prism.js CSS for syntax highlighting (Okaidia theme for dark mode) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <!-- Prism.js core and JavaScript language support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-javascript.min.js"></script>
    <style>
        /* Custom scroll bar styling to match the gray scroll bar in the image */
        .code-window::-webkit-scrollbar {
            width: 10px;
        }

        .code-window::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        .code-window::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <div class="flex flex-col md:flex-row bg-gray-900 p-8 min-h-screen">
        <!-- Left Section: Text Description -->
        <div class="md:w-1/2 pr-8">
            <h2 class="text-cyan-400 uppercase text-lg font-semibold">INTEGRATE</h2>
            <h1 class="text-white text-3xl font-bold mt-2 leading-tight">Superpower your workflow with rapid integration
                flows.</h1>
            <p class="text-white mt-4 text-base">Bring the power of Zapp! to your own workflow. Rapidly remote build,
                instantly analyze and compile your project with our powerful integrations API.</p>
            <p class="text-orange-400 mt-4 text-base">Integration is currently in private beta. Please contact us to
                learn more about custom integrations.</p>
            <ul class="mt-4 space-y-2">
                <li class="text-white flex items-center"><span class="text-green-400 mr-2">✓</span> Remote build your
                    application, 100x faster than traditional Flutter builds.</li>
                <li class="text-white flex items-center"><span class="text-green-400 mr-2">✓</span> Analyze and compile
                    on the browser by integrating with our JavaScript SDKs.</li>
                <li class="text-white flex items-center"><span class="text-green-400 mr-2">✓</span> Integrate with our
                    GitHub Action to build Flutter apps in record time on your CI/CD.</li>
            </ul>
            <button
                class="mt-6 px-4 py-2 border border-cyan-400 text-cyan-400 rounded-full flex items-center hover:bg-cyan-400 hover:text-gray-900 transition">Learn
                more <span class="ml-2">→</span></button>
        </div>

        <!-- Right Section: Interactive Code Snippet -->
        <div class="md:w-1/2 mt-8 md:mt-0">
            <!-- Tabs -->
            <div class="flex space-x-4">
                <button class="text-cyan-400 border-b-2 border-cyan-400 pb-2 font-medium">Compile</button>
                <button class="text-gray-400 pb-2 font-medium hover:text-cyan-400 transition">Analyze</button>
                <button class="text-gray-400 pb-2 font-medium hover:text-cyan-400 transition">Remote Builds</button>
                <button class="text-gray-400 pb-2 font-medium hover:text-cyan-400 transition">CI/CD</button>
            </div>
            <!-- Code Window -->
            <div class="bg-black rounded-lg shadow-lg mt-4 p-4 relative">
                <!-- Window Decorations (macOS-style dots) -->
                <div class="absolute top-2 left-2 flex space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                </div>
                <!-- Scrollable Code with Syntax Highlighting -->
                <pre class="language-javascript code-window overflow-y-auto h-64 pt-6 text-sm"><code>&lt;php&gt;
    public function save(Request $request, $id = null)
    {

        dd($request->all());
        if ($id) {
            if (!Auth::user()->can('buttons.update')) {
                abort(403, 'Unauthorized update action.');
            }
        } else {
            if (!Auth::user()->can('buttons.store')) {
                abort(403, 'Unauthorized create action.');
            }
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'nullable|integer|required_without:url',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', $validator->errors()->first()) // Get the first error message
                ->withErrors($validator)
                ->withInput();
        }

       $data = $request->only([
            'title',
            'alias',
            'url',
            'target',
            'content_from',
            'content_id',
            'destination_to',
            'destination_id',
            'publish',
        ]);

        $templateId = $request->input('template_id');
        $childId = $request->input('child_id');

        if ($request->input('content')) {
            $table = $request->input('content_table');
            $contentId = $request->input('content');
            $data['url'] = "{$table},{$contentId}";
            $data['entries'] = "{$table},{$contentId}";
        } else {
            $data['entries'] = null;
        }

        $data['status'] = isset($data['publish']) && $data['publish'] === 'true' ? 1 : -1;
        unset($data['publish']);

        if ($id) {
            // Update item
            $item = Button::findOrFail($id);
            // $oldTemplateId = $item->template_id;
            $item->update($data);
            $message = 'Button updated successfully!';
        } else {
            // Create new item
            $data['alias'] = isset($data['title']) ? Str::slug($data['title']) : null;
            $item = Button::create($data);
            $oldTemplateId = null;
            $message = 'Button created successfully!';
        }

        // Call function to update template entries
        // Call function to update template entries
        $this->templateService->updateTemplateEntries('Button', $templateId,
        $childId, $item->buttons_id, $item->status);

        // $this->updateTemplateEntries($oldTemplateId, $newTemplateId, $item->buttons_id);
        // Redirect based on user role/permission
        if (Auth::user()->hasRole('superadmin') || Auth::user()->hasPermissionTo('buttons.index')) {
            return redirect()->route('buttons.index')->with('success', $message);
        }
        return redirect()->back()->with('success', $message);
    }

&lt;/php&gt;</code></pre>
            </div>
        </div>
    </div>
</body>

</html>
 --}}
