if tMorphLoaded then return end
tMorphLoaded = true

local fixRaidFrames = false
local hideArenaFlags = false

print("|cFFDC143CtMorph|r |cFF40E0D0(MOP Edition)|r loaded.")

-- Commands

local oldChatEdit_SendText = ChatEdit_SendText
ChatEdit_SendText = function(editBox, addHistory)
  local text = editBox:GetText()
  if text:len() < 4 or text:sub(1, 1) ~= "." or not text:sub(2, 2):match("%a") then
    oldChatEdit_SendText(editBox, addHistory)
    return
  end

  local command, arg = strsplit(" ", text:sub(2), 2)

  if command == "help" then
    print("|cFFDC143CtMorph|r commands:")
    print("  .morph |cFFCCCCCC<display id>|r")
    print("  .race |cFFCCCCCC<1-24>|r")
    print("  .gender")
    print("  .mount |cFFCCCCCC<display id>|r")
    print("  .item |cFFCCCCCC<1-19> <item id>|r")
    print("  .enchant |cFFCCCCCC<1-2> <enchant id>|r")
    print("  .spell |cFFCCCCCC<spell id> <new spell id>|r")
    print("  .title |cFFCCCCCC<1-" .. GetNumTitles() .. ">|r")
    print("  .scale |cFFCCCCCC<scale>|r")
    return
  end

  if command == "fix-raid" then
    fixRaidFrames = true
    CompactRaidFrameContainer_SetFlowSortFunction(CompactRaidFrameManager.container, CRFSort_Group)
    return
  end

  if command == "hide-flags" then
    print("|cFFDC143CtMorph|r: Arena flags should no longer be displayed for all subsequent matches.")
    hideArenaFlags = true
    return
  end

  if command == "gender" then
    if tonumber(arg) ~= nil then
      SetGender("player", arg)
    else
      if GetGender("player") == 1 then
        SetGender("player", 0)
      else
        SetGender("player", 1)
      end
    end
    local race = GetAlternateRace("player")
    if race == 0 then
      race = GetRace("player")
    end
    SetAlternateRace("player", race)
    UpdateModel("player")
    return
  end

  if command == "reset" then
    for slot = 1, 19 do
      local item = GetInventoryItemID("player", slot)
      if item then
        SetVisibleItem("player", slot, item)
      else
        SetVisibleItem("player", slot, 0)
      end
    end
    SetAlternateRace("player", 0)
    SetDisplayID("player", 0)
    ClearSettings()
    UpdateModel("player")
    return
  end

  if arg == nil then return end

  if command == "morph" and tonumber(arg) ~= nil then
    SetDisplayID("player", arg, true)
    UpdateModel("player")
    return
  end

  if command == "mount" and tonumber(arg) ~= nil then
    SetMountDisplayID("player", arg)
    return
  end

  if command == "race" and tonumber(arg) ~= nil then
    SetDisplayID("player", 0, true)
    SetAlternateRace("player", arg)
    UpdateModel("player")
    return
  end

  if command == "title" and tonumber(arg) ~= nil then
    SetTitle("player", arg)
    UpdateModel("player")
    return
  end

  if command == "scale" and tonumber(arg) ~= nil then
    SetScale("player", arg)
    return
  end

  local appearanceCmds = { skin = 1, face = 2, hair = 3, haircolor = 4, piercings = 5 }

  if appearanceCmds[command] and tonumber(arg) ~= nil then
    local featureID = appearanceCmds[command]
    SetAppearance("player", featureID, arg)
    UpdateModel("player")
    return
  end

  local arg1, arg2 = strsplit(" ", arg, 2)

  if command == "item" and tonumber(arg1) ~= nil and tonumber(arg2) ~= nil then
    SetVisibleItem("player", arg1, arg2)
    UpdateModel("player")
    return
  end

  if command == "enchant" and tonumber(arg1) ~= nil and tonumber(arg2) ~= nil then
    if tonumber(arg1) == 1 then
      SetVisibleEnchant("player", 16, arg2)
    elseif tonumber(arg1) == 2 then
      SetVisibleEnchant("player", 17, arg2)
    else
      SetVisibleEnchant("player", arg1, arg2)
    end
    UpdateModel("player")
    return
  end

  if command == "spell" and tonumber(arg1) ~= nil and tonumber(arg2) ~= nil then
    SetSpellVisual(arg1, arg2)
    return
  end
end

-- Events

local events = CreateFrame("Frame")
events:SetScript("OnEvent", function(self, event, ...) return self[event](self, ...) end)

function events:PLAYER_ENTERING_WORLD()
  if hideArenaFlags then
    SetSpellVisual(32724, 96285)
    SetSpellVisual(32725, 96285)
    SetSpellVisual(35774, 96285)
    SetSpellVisual(35775, 96285)
  end
end

function events:PLAYER_LOGOUT()
  ClearSettings()
end

events:RegisterEvent("PLAYER_ENTERING_WORLD")
events:RegisterEvent("PLAYER_LOGOUT")

-- Hackish fix to persist our settings through UI reloads.

local oldReloadUI = ReloadUI
function ReloadUI()
  events:UnregisterEvent("PLAYER_LOGOUT")
  oldReloadUI()
end

local oldConsoleExec = ConsoleExec
function ConsoleExec(msg)
  if msg:lower() == "reloadui" then
    events:UnregisterEvent("PLAYER_LOGOUT")
  end
  oldConsoleExec(msg)
end

-- Extends the item click functionality.

local invTypeMap = {
  INVTYPE_HEAD           = 1,
  INVTYPE_SHOULDER       = 3,
  INVTYPE_BODY           = 4,
  INVTYPE_CHEST          = 5,
  INVTYPE_ROBE           = 5,
  INVTYPE_WAIST          = 6,
  INVTYPE_LEGS           = 7,
  INVTYPE_FEET           = 8,
  INVTYPE_WRIST          = 9,
  INVTYPE_HAND           = 10,
  INVTYPE_CLOAK          = 15,
  INVTYPE_WEAPON         = 16,
  INVTYPE_SHIELD         = 17,
  INVTYPE_2HWEAPON       = 16,
  INVTYPE_WEAPONMAINHAND = 16,
  INVTYPE_WEAPONOFFHAND  = 17,
  INVTYPE_HOLDABLE       = 17,
  INVTYPE_RANGED         = 16,
  INVTYPE_TABARD         = 19,
}

oldHandleModifiedItemClick = HandleModifiedItemClick
function HandleModifiedItemClick(link)
  if link and IsDressableItem(link) and IsLeftAltKeyDown() then
    local _, itemID = strsplit(":", link)
    local _, _, _, _, _, _, _, _, equipLoc = GetItemInfo(itemID)
    if invTypeMap[equipLoc] then
      SetVisibleItem("player", invTypeMap[equipLoc], itemID)
      UpdateModel("player")
    end
    return true
  end
  return oldHandleModifiedItemClick(link)
end

-- Correct raid frame sorting in arena.

oldCRFSort_Group = CRFSort_Group
CRFSort_Group = function(token1, token2)
  if IsActiveBattlefieldArena() == nil or not fixRaidFrames then
    return oldCRFSort_Group(token1, token2)
  end

  local id1 = tonumber(string.sub(token1, 5));
  local id2 = tonumber(string.sub(token2, 5));

  if not id1 or not id2 then
    return id1
  end

  local name1, _, _, _, class1 = GetRaidRosterInfo(id1);
  local name2, _, _, _, class2 = GetRaidRosterInfo(id2);

  if name1 == UnitName("player") then
    return false
  end

  if name2 == UnitName("player") then
    return true
  end

  return id1 < id2
end
