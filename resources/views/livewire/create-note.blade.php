<div>
    <flux:modal name="create-note" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Note</flux:heading>
                <flux:text class="mt-2">Make changes to your Notes.</flux:text>
            </div>

            <flux:input label="Title" placeholder="Your title" wire:model="title" />
            <flux:textarea label="Content" placeholder="Input Content" wire:model="content" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="save">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
